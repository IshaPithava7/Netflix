<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'title_poster',
        'uploaded_by',
        'poster',
        'tmdb_id'
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function usersAdded()
    {
        return $this->belongsToMany(User::class, 'user_video')->withTimestamps();
    }

    public function types()
    {
        return $this->belongsToMany(Type::class, 'type_video', 'video_id', 'type_id');
    }

    public function collections()
    {
        return $this->belongsToMany(Collection::class, 'collection_video', 'video_id', 'collection_id')
            ->withPivot('position')
            ->withTimestamps();
    }


}
