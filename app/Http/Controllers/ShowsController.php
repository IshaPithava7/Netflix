<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Collection;
use App\Models\Type;
use App\Models\Video;
use Illuminate\Http\Request;
=======
use App\Services\ContentPageService;
use App\Models\Video;
use App\Models\Collection;
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
use Illuminate\Support\Facades\Auth;

class ShowsController extends Controller
{
<<<<<<< HEAD
    public function Shows()
    {
        $user = Auth::user();

        $genres = Type::pluck('name')->toArray();
        $collectionGenre = array_chunk($genres, ceil(count($genres) / 3));

=======
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

>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
        $localVideos = Video::select([
            'id',
            'title',
            'poster',
            'file_path',
            'title_poster',
            'description'
        ])->limit(10)->get();

<<<<<<< HEAD
        $myListIdsMap = [];
        if ($user) {
            $myListIds = $user->myListVideos()
                ->pluck('videos.id')
                ->toArray();

            $myListIdsMap = array_flip($myListIds);
        }

=======
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
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
<<<<<<< HEAD
            'collectionGenre' => $collectionGenre,
=======
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
            'localVideos' => $localVideos,
            // 'allCollections' => $allCollections,
            'mainCollections' => $mainCollections,
            'heroCollection' => $heroCollection,
            'top10Collection' => $top10Collection,
            // 'myListIds' => $myListIdsMap,
        ]);
    }
<<<<<<< HEAD

  
=======
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
}
