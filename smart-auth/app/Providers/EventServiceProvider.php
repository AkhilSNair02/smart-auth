<?php

namespace App\Providers;

use App\Events\ForgotPasswordRequested;
use App\Events\UserRegistered;
use App\Events\UserVerified;
use App\Listeners\SendOtpEmail;
use App\Listeners\SendResetOtpEmail;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserRegistered::class => [
            SendOtpEmail::class,
        ],
        UserVerified::class => [
            SendWelcomeEmail::class,
        ],
        ForgotPasswordRequested::class => [
            SendResetOtpEmail::class,
        ],
    ];

    public function boot(): void {}
}