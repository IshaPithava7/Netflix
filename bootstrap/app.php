<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            // Register Admin Route File
            Route::middleware(['web', 'auth', 'IsAdmin'])     // <-- middleware (optional)
                ->prefix('admin')                   // <-- URL prefix (optional)         
                ->name('admin.')                    // <-- Route name prefix (optional)            
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'encrypt.response' => \App\Http\Middleware\EncryptResponse::class,
            'decrypt.request' => \App\Http\Middleware\DecryptRequest::class,
            'IsAdmin' => \App\Http\Middleware\IsAdmin::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
