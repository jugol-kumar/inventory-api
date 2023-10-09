<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObsarverServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
}
