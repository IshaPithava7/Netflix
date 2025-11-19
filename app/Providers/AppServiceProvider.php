<?php

namespace App\Providers;

use Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Gate::define('isAdmin', function ($user) {
            return $user->hasRole('Admin');
        });


        Blade::component('layouts.app', 'layouts.app');
        Blade::component('layouts.auth', 'layouts.auth');

        Blade::component('layouts.app.navbar', 'navbar');
        Blade::component('layouts.app.footer', 'footer');

    }
}


