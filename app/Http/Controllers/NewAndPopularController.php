<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Video;
use Illuminate\Http\Request;

class NewAndPopularController extends Controller
{
    public function newAndPopular()
    {
        $collections = Collection::with([
            'videos' => function ($q) {
                $q->select('videos.id', 'title', 'poster', 'file_path', 'title_poster', 'description');
            }
        ])
        ->limit(5)
        ->get();

        return view('home.new-popular', compact('collections'));
    }


}
