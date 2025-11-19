<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function videos()
    {
        return $this->belongsToMany(
            Video::class,
            'collection_video',
            'collection_id',
            'video_id'
        )
            ->withPivot('position')
            ->withTimestamps();
    }

}
