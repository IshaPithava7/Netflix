<?php

namespace App\Services;

use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;

class LanguageService
{
    public function getVideosByLanguage(): Collection
    {
        return Video::all()->groupBy('language');
    }
}
