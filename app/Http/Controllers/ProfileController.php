<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{

    /**
     * Store a new user profile.
     */
    public function store(StoreProfileRequest $StoreProfileRequest)
    {
        $data = $StoreProfileRequest->validated();

        // Handle avatar upload (if present)
        $avatarPath = null;

        if ($StoreProfileRequest->hasFile('avatar')) {
            $avatarPath = $StoreProfileRequest->file('avatar')->store('avatars', 'public');
        }

        // Create the profile
        Auth::user()->profiles()->create([
            'name'   => $data['name'],
            'avatar' => $avatarPath,
            'type'   => $data['type'] ?? 'general',
        ]);

        return back()->with('success', 'Profile added successfully!');
    }

}
