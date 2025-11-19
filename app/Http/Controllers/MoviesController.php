<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Video::take(10)->get();

        return view('home.movies', compact('movies'));
    }
}
