<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
    public function createProfile(Request $request, array $data): void
    {
        Auth::user()->profiles()->create([
            'name'   => $data['name'],
            'avatar' => $data['avatar'] ?? null,
        ]);
    }
}
