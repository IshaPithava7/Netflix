<?php

namespace App\Providers;

use App\View\Composers\ProfileComposer;
use App\View\Composers\AccountComposer;
use Gate;
use Illuminate\Support\Facades\View;
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

        View::composer('layouts.app.navbar', ProfileComposer::class);
        View::composer('account.account', AccountComposer::class);
    }
}


