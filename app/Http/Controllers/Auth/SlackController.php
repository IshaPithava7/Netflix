<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SlackController extends Controller
{
    public function redirectToSlack()
    {
        return Socialite::driver('slack')->redirect();
    }

    public function handleSlackCallback()
    {
        try {
            $slackUser = Socialite::driver('slack')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Unable to login with Slack.');
        }

        // Find or create user
        $user = User::firstOrCreate(
            ['email' => $slackUser->getEmail()],
            [
                'name' => $slackUser->getName(),
                'password' => bcrypt(Str::random(16)), // random password
            ]
        );

        auth()->login($user, true);

        return redirect()->intended('/home');
    }
}
