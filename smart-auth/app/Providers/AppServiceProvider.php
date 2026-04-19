<?php

namespace App\Providers;

use App\Repositories\Eloquent\OtpRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\OtpRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OtpRepositoryInterface::class, OtpRepository::class);
    }

    public function boot(): void {}
}