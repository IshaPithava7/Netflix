<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

class browseBylanguageController extends Controller
{
     public function browseBylanguage()
    {
        $collections = Collection::with([
            'videos' => function ($q) {
                $q->select('videos.id', 'title', 'poster', 'file_path', 'title_poster', 'description');
            }
        ])
        ->limit(5)
        ->get();

        return view('home.browse-languages', compact('collections'));
    }

}
