<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendOtpEmail
{
    public function handle(UserRegistered $event): void
    {
        Log::info('OTP for ' . $event->user->email . ': ' . $event->otp);

        Mail::to($event->user->email)
            ->send(new SendOtpMail($event->otp));
    }
}