<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index()
    {
        $shows = Video::where('for_kids', true)
            ->whereHas('types', function ($query) {
                $query->where('name', 'TV Show');
            })
            ->get();

        return view('kids.pages.shows', compact('shows'));
    }
}
