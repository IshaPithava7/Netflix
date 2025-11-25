<?php

namespace App\Http\Controllers;

use App\Services\LanguageService;

class BrowseByLanguageController extends Controller
{
    protected $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    public function browseBylanguage ()
    {
        $videosByLanguage = $this->languageService->getVideosByLanguage();
        return view('home.browse-languages', compact('videosByLanguage'));
    }
}
