<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Services\NewAndPopularService;

class NewAndPopularController extends Controller
{
    protected $newAndPopularService;

    public function __construct(NewAndPopularService $newAndPopularService)
    {
        $this->newAndPopularService = $newAndPopularService;
    }

    public function NewAndPopular()
    {

        $collections  = Collection::with([
            'videos' => function ($q) {
                $q->select('videos.id', 'title', 'poster', 'file_path', 'title_poster', 'description');
            }
        ])
            ->has('videos')
            ->orderBy('id', 'asc')
            ->get()
            ->take(5);

        return view('home.new-popular', [
            'collections' => $collections,
        ]);
    }
}
