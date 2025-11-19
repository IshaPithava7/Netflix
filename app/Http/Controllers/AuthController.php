<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\UserServices;
use Arr;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Events\UserRegistered;


class AuthController extends Controller
{

    public function checkEmail(AuthRequest $AuthRequest)
    {
        $user = User::where('email', $AuthRequest->email)->first();

        if ($user) {
            return redirect()->route('loginPage')->with('email', $AuthRequest->email);
        } else {
            return redirect()->route('registerPage')->with('email', $AuthRequest->email);
        }
    }

    public function showRegister(Request $request)
    {
        $email = $request->session()->get('email');
        return view('layouts.auth.register', compact('email'));
    }

    public function register(RegisterRequest $request, UserServices $userService)
    {
        $user = $userService->register($request->validated());

        $role = Role::where('name', 'USER')->first();

        $user->roles()->syncWithoutDetaching([$role->id]);

        $user->sendEmailVerificationNotification();

        UserRegistered::dispatch($user);

        return redirect()->route('verification.notice')
            ->with('status', 'We have sent you a verification email. Please verify to continue.');
    }

    public function showLogin(Request $request)
    {
        $email = $request->session()->get('email');
        return view('layouts.auth.login', compact('email'));
    }

    public function login(LoginRequest $loginRequest)
    {
        $credentials = $loginRequest->validated();

        $loginRequest->session()->regenerate();

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            if ($user->hasRole('Admin')) {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Welcome back Admin!');
            }

            if ($user->subscribed('default')) {
                return redirect()->route('home')
                    ->with('success', 'Welcome back! You already have an active plan.');
            }

            return redirect()->route('subscription')
                ->with('success', 'Welcome! Please choose a plan to continue.');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('dashboard');
    }

    public function showForgotPassword()
    {
        return view('layouts.auth.forgot-password');
    }

    public function sendResetLinkEmail(AuthRequest $AuthRequest)
    {
        $data = $AuthRequest->validated();

        $status = Password::sendResetLink([
            'email' => $data['email'],
        ]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm($token)
    {
        return view('layouts.auth.reset-password', ['token' => $token]);
    }


    public function resetPassword(ResetPasswordRequest $ResetPasswordRequest)
    {
        $data = $ResetPasswordRequest->validated();

        $status = Password::reset(
            $data = Arr::only($data, [
                'email',
                'password',
                'password_confirmation',
                'token'
            ]),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('loginPage')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function deleteAccount(Request $request)
    {
        $user = $request->user();

        if ($user->subscribed('default')) {
            $user->subscription('default')->cancelNow();
        }

        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }


}
