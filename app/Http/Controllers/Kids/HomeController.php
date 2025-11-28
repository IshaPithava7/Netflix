<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        session()->put('kids_mode', true);
        // For now, we'll just fetch all videos marked for kids.
        // We can add more complex logic for collections, etc. later.
        $videos = Video::where('for_kids', true)->get();

        return view('kids.home', compact('videos'));
    }

    public function exit()
    {
        session()->forget('kids_mode');
        return redirect()->route('home');
    }
}
