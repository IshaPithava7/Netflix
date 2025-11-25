<?php

namespace App\Services;

use App\Models\Video;

class NewAndPopularService
{
    public function getLatestVideos()
    {
        return Video::latest()->take(10)->get();
    }

    public function getPopularVideos()
    {
        return Video::withCount('watchHistory')->orderBy('watch_history_count', 'desc')->take(10)->get();
    }
}
