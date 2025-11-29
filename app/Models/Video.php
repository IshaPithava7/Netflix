<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ForKidsScope;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'trailer',
        'origin_movie',
        'mini_poster',
        'uploaded_by',
        'poster'
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function usersAdded()
    {
        return $this->belongsToMany(User::class, 'user_video')->withTimestamps();
    }

    protected static function booted()
    {
        static::addGlobalScope(new ForKidsScope);
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
