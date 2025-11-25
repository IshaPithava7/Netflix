<?php

namespace App\Http\Controllers;

use App\Services\ContentPageService;
use App\Models\Video;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;

class ShowsController extends Controller
{
    protected $contentPageService;

    public function __construct(ContentPageService $contentPageService)
    {
        $this->contentPageService = $contentPageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function shows()
    {
        $user = Auth::user();

        $localVideos = Video::select([
            'id',
            'title',
            'poster',
            'file_path',
            'title_poster',
            'description'
        ])->limit(10)->get();

        $allCollections = Collection::with([
            'videos' => function ($q) {
                $q->select('videos.id', 'title', 'poster', 'file_path', 'title_poster', 'description');
            }
        ])
            ->has('videos')
            ->orderBy('id', 'asc')
            ->get();

        $heroCollection = Collection::firstWhere('title', 'Hero Section');

        $top10Collection = Collection::firstWhere('title', 'Top 10 Shows in India Today');


        $mainCollections = $allCollections
            ->reject(fn($c) => ($heroCollection && $c->id === $heroCollection->id)
                || ($top10Collection && $c->id === $top10Collection->id))
            ->filter(fn($c) => $c->videos->isNotEmpty())
            ->values();


        return view('home.shows', [
            // 'user' => $user,
            'localVideos' => $localVideos,
            // 'allCollections' => $allCollections,
            'mainCollections' => $mainCollections,
            'heroCollection' => $heroCollection,
            'top10Collection' => $top10Collection,
            // 'myListIds' => $myListIdsMap,
        ]);
    }
}
