<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToggleRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\MyListService;

class MyListController extends Controller
{
    protected $myListService;

    public function __construct(MyListService $myListService)
    {
        $this->myListService = $myListService;
    }

    /**
     * Toggle a video in or out of the user's "My List".
     */
    public function toggle(ToggleRequest $request)
    {
        $status = $this->myListService->toggleVideo($request->validated()['video_id'], Auth::user());
        return response()->json(['status' => $status]);
    }

    /**
     * Display all videos in the authenticated user's "My List".
     */
    public function mylist()
    {
        $user = Auth::user();
        $videos = $this->myListService->getUserList($user);
        $myListIds = $videos->pluck('id')->flip()->toArray();

        return view('mylist.mylist', compact('videos', 'user', 'myListIds'));
    }
}
