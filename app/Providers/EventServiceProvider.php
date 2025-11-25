<?php

namespace App\Providers;


use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\UserRegistered::class => [
            \App\Listeners\SendWelcomeEmail::class,
        ],
        SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\\LinkedIn\\OpenID\\LinkedInExtendSocialite@handle',
        ],
    ];

    public function boot(): void
    {
        //
    }
}
