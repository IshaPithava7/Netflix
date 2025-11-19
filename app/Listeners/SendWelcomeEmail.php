<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomeEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event)
    {
        logger('Inside listener: sending mail to ' . $event->user->email);

        Mail::to($event->user->email)->later(now()->addMinutes(1), new WelcomeMail($event->user));

        logger('Email send attempt finished.');
    }
}
