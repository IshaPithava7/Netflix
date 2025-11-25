<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class MyListService
{
    public function toggleVideo(int $videoId, User $user): string
    {
        $status = $user->myList()->toggle($videoId);
        return !empty($status['attached']) ? 'added' : 'removed';
    }

    public function getUserList(User $user): Collection
    {
        return $user->myListVideos()
            ->with(['types:id,name'])
            ->get(['videos.id', 'videos.title', 'videos.poster', 'videos.file_path', 'videos.title_poster', 'videos.description']);
    }
}
