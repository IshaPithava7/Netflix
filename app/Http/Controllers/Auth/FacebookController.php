<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            // Check if user already exists
            $user = User::where('facebook_id', $facebookUser->id)->first();

            if (!$user) {
                // Create a new user
                $user = User::create([
                    'name' => $facebookUser->name,
                    'email' => $facebookUser->email ?? $facebookUser->id . '@facebook.com', // in case email is null
                    'facebook_id' => $facebookUser->id,
                    'password' => bcrypt(uniqid()), // random password
                ]);
            }

            // Login the user
            Auth::login($user, true);

            return redirect()->intended('/home');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to login using Facebook.');
        }
    }

    public function facebookDataDeletion(Request $request)
    {
        $signedRequest = $request->input('signed_request');

        if (!$signedRequest) {
            return response()->json(['error' => 'No signed request'], 400);
        }

        // Decode the signed request
        list($encodedSig, $payload) = explode('.', $signedRequest, 2);

        $data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);

        $facebookUserId = $data['user_id'] ?? null;

        if ($facebookUserId) {
            // Delete user data from database
            $user = User::where('facebook_id', $facebookUserId)->first();
            if ($user) {
                $user->delete();
            }
        }

        // Respond to Facebook with a confirmation URL
        return response()->json([
            'url' => 'http://127.0.0.1:8000/deletion-confirmation'
        ]);
    }
}
