<?php

namespace App\Listeners;

use App\Events\UserVerified;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail
{
    public function handle(UserVerified $event): void
    {

        Log::info('Welcome Email Triggered', [
            'email' => $event->user->email,
            'user' => $event->user->name
        ]);

    }
}