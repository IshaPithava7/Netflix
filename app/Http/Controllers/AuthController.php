<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\UserServices;
use App\Services\AuthService;
use Illuminate\Support\Arr;
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
    protected $authService;
    protected $userService;

    public function __construct(AuthService $authService, UserServices $userService)
    {
        $this->authService = $authService;
        $this->userService = $userService;
    }

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

    public function register(RegisterRequest $request)
    {
        $user = $this->userService->register($request->validated());

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

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }


    public function sendResetLinkEmail(AuthRequest $AuthRequest)
    {
        $status = Password::sendResetLink([
            'email' => $AuthRequest->email,
        ]);

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }


    public function showResetPasswordForm($token)
    {
        return view('layouts.auth.reset-password', ['token' => $token]);
    }


    public function resetPassword(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->validated(),
            function (User $user, string $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }


    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        // Soft delete the user
        $user->delete();

        // Logout the user
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Your account has been successfully deleted.');
    }
}
