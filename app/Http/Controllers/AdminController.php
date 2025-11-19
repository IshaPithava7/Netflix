<?php

namespace App\Http\Controllers;

use App\Models\WatchHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Video;
use App\Http\Middleware\IsAdmin;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(IsAdmin::class)->only(['dashboard', 'users']); 
    }


    public function dashboard()
    {
        return view('admin.dashboard'); 
    }

    public function main_dashboard()
    {
        $totalUsers = User::count();
        $totalVideos = Video::count();
        $latestUsers = User::latest()->take(5)->get();
        $latestVideos = Video::with('uploader')->latest()->take(5)->get();

        $watchHistories = WatchHistory::selectRaw('DATE(created_at) as date, COUNT(*) as views')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $chartLabels = $watchHistories->pluck('date')->map(function ($d) {
            return \Carbon\Carbon::parse($d)->format('M d');
        });
        $chartData = $watchHistories->pluck('views');

        $topVideos = WatchHistory::select('video_id')
            ->selectRaw('COUNT(*) as views')
            ->groupBy('video_id')
            ->orderByDesc('views')
            ->take(5)
            ->get();

        $topVideoTitles = Video::whereIn('id', $topVideos->pluck('video_id'))->pluck('title', 'id');
        $topVideoData = $topVideos->map(fn($v) => $v->views);


        return view('admin.main_dashboard', compact(
            'totalUsers',
            'totalVideos',
            'latestUsers',
            'latestVideos',
            'chartLabels',
            'chartData',
            'topVideoTitles',
            'topVideoData',
        ));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users', compact('users'));
    }
}
