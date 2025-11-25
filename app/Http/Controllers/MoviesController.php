<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Collection;
use App\Models\Type;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function movies()
    {

        $user = Auth::user();
=======
use App\Services\ContentPageService;
use App\Models\Video;
use App\Models\Collection;
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{
    protected $contentPageService;

    public function __construct(ContentPageService $contentPageService)
    {
        $this->contentPageService = $contentPageService;
    }

    public function movies()
    {
         $user = Auth::user();
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8

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

<<<<<<< HEAD
        $genres = Type::pluck('name')->toArray();
        $collectionGenre = array_chunk($genres, ceil(count($genres) / 3));



=======
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
        $heroCollection = Collection::firstWhere('title', 'Hero Section');

        $top10Collection = Collection::firstWhere('title', 'Top 10 Shows in India Today');


        $mainCollections = $allCollections
<<<<<<< HEAD
            ->reject(fn ($c) => ($heroCollection && $c->id === $heroCollection->id)
                || ($top10Collection && $c->id === $top10Collection->id))
            ->filter(fn ($c) => $c->videos->isNotEmpty())
=======
            ->reject(fn($c) => ($heroCollection && $c->id === $heroCollection->id)
                || ($top10Collection && $c->id === $top10Collection->id))
            ->filter(fn($c) => $c->videos->isNotEmpty())
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
            ->values();


        return view('home.movies', [
            // 'user' => $user,
            'localVideos' => $localVideos,
            // 'allCollections' => $allCollections,
<<<<<<< HEAD
            'collectionGenre' => $collectionGenre,
=======
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
            'mainCollections' => $mainCollections,
            'heroCollection' => $heroCollection,
            'top10Collection' => $top10Collection,
            // 'myListIds' => $myListIdsMap,
        ]);
<<<<<<< HEAD
=======
        return view('home.movies', $data);
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
    }
}
