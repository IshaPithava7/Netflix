<?php

// app/Http/Middleware/RedirectIfAdmin.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
