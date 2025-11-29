<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Video::where('for_kids', true)
            ->whereHas('types', function ($query) {
                $query->where('name', 'Movie');
            })
            ->get();

        return view('kids.pages.movies', compact('movies'));
    }
}
