<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;

class LinkedinController extends Controller
{
    // Redirect user to LinkedIn login
    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin-openid')
        ->stateless()
            ->scopes(['openid', 'profile', 'email'])
            ->with(['prompt' => 'consent'])
            ->redirect();
    }

    // Handle callback
    public function handleLinkedInCallback()
    {
        try {
            $linkedinUser = Socialite::driver('linkedin-openid')->stateless()->user();

            // Find user including soft-deleted accounts
            $user = User::withTrashed()->where('email', $linkedinUser->getEmail())->first();

            if ($user && $user->trashed()) {
                // Restore if soft deleted
                $user->restore();
            }

            if (!$user) {
                // Create a new user
                $user = User::create([
                    'name' => $linkedinUser->getName(),
                    'email' => $linkedinUser->getEmail(),
                    'password' => bcrypt(Str::random(32)),
                ]);
            }

            // Assign default role if none exists
            if (!$user->roles()->exists()) {
                $defaultRole = Role::where('name', 'user')->first();
                if ($defaultRole) {
                    $user->roles()->attach($defaultRole->id);
                }
            }

            // Log in the user
            Auth::login($user, true);

            // Admin check
            if (isset($user->is_admin) && $user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            // Check subscription via Cashier
            if (!$user->subscribed('default')) {
                return redirect()->route('subscription.index')
                    ->with('message', 'Welcome! Please choose a subscription plan to continue.');
            }

            return redirect()->route('home');

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
