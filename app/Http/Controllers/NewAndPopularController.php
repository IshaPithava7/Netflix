<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\Collection;
use App\Models\Video;
use Illuminate\Http\Request;

class NewAndPopularController extends Controller
{
    public function newAndPopular()
    {
        $collections = Collection::with([
            'videos' => function ($q) {
                $q->select('videos.id', 'title', 'poster', 'file_path', 'title_poster', 'description');
            }
        ])
        ->limit(5)
        ->get();

        return view('home.new-popular', compact('collections'));
    }


=======
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

        return view('home.new-popular' );
    }
>>>>>>> c9e99602ab009b88ada301ed06b31af527641be8
}
