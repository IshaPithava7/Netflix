<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GithubController extends Controller
{
    public function redirectToGithub()
    {
        return Socialite::driver('github')
            ->stateless()
            ->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();

            // Check if user exists including soft deleted
            $user = User::withTrashed()->where('email', $githubUser->getEmail())->first();

            if ($user && $user->trashed()) {
                $user->restore();
            }

            if (!$user) {
                $user = User::create([
                    'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                    'email' => $githubUser->getEmail(),
                    'password' => bcrypt(Str::random(32)),
                ]);
            }

            // Assign user role if missing
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

            // Check subscription
            if (!$user->subscribed('default')) {
                return redirect()->route('subscription.index')
                    ->with('message', 'Welcome! Please choose a subscription plan to continue.');
            }

            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect()->route('loginPage')
                ->withErrors(['email' => 'GitHub login failed. Please try again.']);
        }
    }
}
