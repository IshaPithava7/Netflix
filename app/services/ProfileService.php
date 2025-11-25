<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function createProfile(Request $request, array $data): void
    {
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        Auth::user()->profiles()->create([
            'name'   => $data['name'],
            'avatar' => $avatarPath,
            'type'   => $data['type'] ?? 'general',
        ]);
    }
}
