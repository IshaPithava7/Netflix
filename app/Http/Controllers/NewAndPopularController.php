<?php

namespace App\Http\Controllers;

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

}
