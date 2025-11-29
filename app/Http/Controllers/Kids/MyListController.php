<?php

namespace App\Http\Controllers\Kids;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyListController extends Controller
{
    public function index()
    {
        $myList = auth()->user()->myListVideos()
            ->where('for_kids', true)
            ->get();

        return view('kids.pages.mylist', compact('myList'));
    }
}
