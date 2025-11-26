<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Services\ProfileService;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $profiles = Auth::user()->profiles;
        return view('profiles.manage', compact('profiles'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Auth::user()->profiles;
            return view('profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $avatars = [
            'https://i.pravatar.cc/150?u=a042581f4e29026704d',
            'https://i.pravatar.cc/150?u=a042581f4e29026704e',
            'https://i.pravatar.cc/150?u=a042581f4e29026704f',
            'https://i.pravatar.cc/150?u=a042581f4e29026704g',
        ];
        return view('profiles.create', compact('avatars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProfileRequest $request)
    {
        $this->profileService->createProfile($request, $request->validated());
        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $avatars = [
            'https://i.pravatar.cc/150?u=a042581f4e29026704d',
            'https://i.pravatar.cc/150?u=a042581f4e29026704e',
            'https://i.pravatar.cc/150?u=a042581f4e29026704f',
            'https://i.pravatar.cc/150?u=a042581f4e29026704g',
        ];
        return view('profiles.edit', compact('profile', 'avatars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|url',
        ]);

        $profile->update($request->all());

        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }

    /**
     * Switch the active profile.
     */
    public function switch(Profile $profile)
    {
        session(['selected_profile_id' => $profile->id]);
        return redirect()->route('home');
    }
}
