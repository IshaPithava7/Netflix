<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->stateless()
            ->with([
                'prompt' => 'select_account consent',
                'access_type' => 'offline',
            ])
            ->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->with(['prompt' => 'consent select_account'])->user();

            $user = User::withTrashed()->where('email', $googleUser->getEmail())->first();

            if ($user && $user->trashed()) {
                // Restore soft deleted user
                $user->restore();
            }

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(32)),
                ]);
            }
            if (!$user->roles()->exists()) {
                $defaultRole = Role::where('name', 'user')->first();
                if ($defaultRole) {
                    $user->roles()->attach($defaultRole->id);
                }
            }

            Auth::login($user, true);

            // Admin check
            if (isset($user->is_admin) && $user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            // Check subscription using Cashier
            if (!$user->subscribed('default')) {
                return redirect()->route('subscription.index')
                    ->with('message', 'Welcome! Please choose a subscription plan to continue.');
            }

            return redirect()->route('home');

        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}