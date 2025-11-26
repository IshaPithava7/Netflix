<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class AuthService
{
    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->validated();
        $request->session()->regenerate();
        $user = User::where('email', $credentials['email'])->first();

        if ($user && $user->trashed()) {
            return back()->withErrors([
                'email' => 'This account has been deleted. Please contact support if you believe this is an error.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole('Admin')) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back Admin!');
            }

            return redirect()->route('profiles.index');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
}
