<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Type;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GamesController extends Controller
{
    public function games()
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


        $genres = Type::pluck('name')->toArray();
        $collectionGenre = array_chunk($genres, ceil(count($genres) / 3));

        $heroCollection = Collection::firstWhere('title', 'Hero Section');

        $top10Collection = Collection::firstWhere('title', 'Top 10 Shows in India Today');


        $mainCollections = $allCollections

            ->reject(fn($c) => ($heroCollection && $c->id === $heroCollection->id)
                || ($top10Collection && $c->id === $top10Collection->id))
            ->filter(fn($c) => $c->videos->isNotEmpty())

            ->values();

        $viewData = [
            // 'user' => $user,
            'localVideos' => $localVideos,
            // 'allCollections' => $allCollections,
            'collectionGenre' => $collectionGenre,
            'mainCollections' => $mainCollections,
            'heroCollection' => $heroCollection,
            'top10Collection' => $top10Collection,
        ];


        return view('home.games', $viewData);
    }
}
