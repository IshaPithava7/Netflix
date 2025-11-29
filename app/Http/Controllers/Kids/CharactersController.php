<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class CharactersController extends Controller
{
    public function index()
    {
        $videos = Video::where('for_kids', true)->get();
        
        return view('kids.pages.characters', compact('videos'));
    }
}
