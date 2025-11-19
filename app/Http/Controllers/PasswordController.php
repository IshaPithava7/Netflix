<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
   /**
     * Show the password change form.
     */
    public function edit()
    {
        return view('account.password.password_change');
    }

    /**
     * Handle password update for the authenticated user.
     */
    public function update(UpdatePasswordRequest $UpdatePasswordRequest)
    {

        $user = Auth::user();

      
        $user->update([
            'password' => Hash::make($UpdatePasswordRequest->new_password),
        ]);

        Auth::logoutOtherDevices($UpdatePasswordRequest->new_password);

        $UpdatePasswordRequest->session()->regenerate();

        return back()->with('status', '✅ Password updated successfully!');
    }
}
