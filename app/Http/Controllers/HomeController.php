<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection;
use App\Models\Video;

class HomeController extends Controller
{


    public function dashboard()
    {
        return view('dashboard');
    }


    public function home()
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


        return view('home.home', [
            // 'user' => $user,
            'localVideos' => $localVideos,
            // 'allCollections' => $allCollections,
            'mainCollections' => $mainCollections,
            'heroCollection' => $heroCollection,
            'top10Collection' => $top10Collection,
            // 'myListIds' => $myListIdsMap,
        ]);
    }

    // 🚀 Lazy-load API
    public function loadMoreCollections(Request $request)
    {
        $skipId = [1, 16];

        // Laravel handles page automatically from ?page=2,3,4...
        $perPage = 3;

        $collections = Collection::with([
            'videos' => function ($q) {
                $q->select('videos.id', 'title', 'poster', 'file_path', 'title_poster', 'description');
            }
        ])
            ->whereNotIn('id', $skipId)
            ->orderBy('id', 'asc')
            ->paginate($perPage);

        // If no more pages left → tell frontend "done"
        if ($collections->isEmpty()) {
            return response()->json(['done' => true]);
        }

        // Render Blade partial
        $html = view('home.collections.collection_section', compact('collections'))->render();

        return response()->json([
            'html' => $html,
            'next_page' => $collections->nextPageUrl() ? true : false
        ]);
    }




    /**
     * Show account overview settings page.
     */
    public function accountSettings()
    {
        return view('account.pages.overview');
    }



}
