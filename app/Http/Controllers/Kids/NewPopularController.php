<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class NewPopularController extends Controller
{
    public function index()
    {
        $newAndPopular = Video::where('for_kids', true)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        return view('kids.pages.newpopular', compact('newAndPopular'));
    }
}
