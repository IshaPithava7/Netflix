<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class TwitterController extends Controller
{
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        try {
            $twitterUser = Socialite::driver('twitter')->stateless()->user();

            $user = User::withTrashed()->where('email', $twitterUser->getEmail())->first();

            if ($user && $user->trashed()) {
                $user->restore();
            }

            if (!$user) {
                $user = User::create([
                    'name'  => $twitterUser->getName(),
                    'email' => $twitterUser->getEmail(),
                    'password' => bcrypt(Str::random(32)),
                ]);
            }

            // Assign default role
            if (!$user->roles()->exists()) {
                $defaultRole = Role::where('name', 'user')->first();
                if ($defaultRole) {
                    $user->roles()->attach($defaultRole->id);
                }
            }

            Auth::login($user, true);

            // Check subscription
            if (!$user->subscribed('default')) {
                return redirect()->route('subscription.index')
                    ->with('message', 'Welcome! Please choose a subscription plan.');
            }

            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect()->route('loginPage')
                ->withErrors(['email' => 'Twitter login failed. Please try again.']);
        }
    }
}
