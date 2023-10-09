<?php

namespace App\Providers;

use App\Http\Resources\Api\V1\UserCollection;
use Illuminate\Support\ServiceProvider;

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
        UserCollection::withoutWrapping();
    }
}
