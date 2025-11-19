<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToggleRequest;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class MyListController extends Controller
{

    /**
     * Toggle a video in or out of the user's "My List".
     */
    public function toggle(ToggleRequest $ToggleRequest)
    {
        $videoId = $ToggleRequest->validated();

        $user = Auth::user();
        $status = $user->myList()->toggle($videoId);

        return response()->json([
            'status' => !empty($status['attached']) ? 'added' : 'removed'

        ]);
    }


    /**
     * Display all videos in the authenticated user's "My List".
     */
    public function mylist()
    {
        $user = Auth::user();

        //  Eager load all necessary relationships to prevent lazy loading
        $videos = $user->myListVideos()
            ->with(['types:id,name'])
            ->get(['videos.id', 'videos.title', 'videos.poster', 'videos.file_path', 'videos.title_poster', 'videos.description']);

        // Preload all My List video IDs once
        $myListIds = $videos->pluck('id')->flip()->toArray(); // flip for quick lookup

        return view('mylist.mylist', compact('videos', 'user', 'myListIds'));
    }
}
