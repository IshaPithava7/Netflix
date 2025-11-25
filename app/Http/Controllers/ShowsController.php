<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Type;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowsController extends Controller
{
    public function Shows()
    {
        $user = Auth::user();

        $genres = Type::pluck('name')->toArray();
        $collectionGenre = array_chunk($genres, ceil(count($genres) / 3));

        $localVideos = Video::select([
            'id',
            'title',
            'poster',
            'file_path',
            'title_poster',
            'description'
        ])->limit(10)->get();

        $myListIdsMap = [];
        if ($user) {
            $myListIds = $user->myListVideos()
                ->pluck('videos.id')
                ->toArray();

            $myListIdsMap = array_flip($myListIds);
        }

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
            'collectionGenre' => $collectionGenre,
            'localVideos' => $localVideos,
            // 'allCollections' => $allCollections,
            'mainCollections' => $mainCollections,
            'heroCollection' => $heroCollection,
            'top10Collection' => $top10Collection,
            // 'myListIds' => $myListIdsMap,
        ]);
    }

  
}
