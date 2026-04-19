<?php

namespace App\Listeners;

use App\Events\ForgotPasswordRequested;
use App\Mail\ResetOtpMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendResetOtpEmail
{
    public function handle(ForgotPasswordRequested $event): void
    {
        Log::info('Reset OTP for ' . $event->user->email . ': ' . $event->otp);

        Mail::to($event->user->email)
            ->send(new ResetOtpMail($event->otp));
    }
}