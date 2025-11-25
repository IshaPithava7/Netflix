<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Services\ProfileService;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Store a new user profile.
     */
    public function store(StoreProfileRequest $request)
    {
        $this->profileService->createProfile($request, $request->validated());
        return back()->with('success', 'Profile added successfully!');
    }
}
