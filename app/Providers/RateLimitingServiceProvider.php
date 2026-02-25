<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class RateLimitingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // RateLimiter For Writing Operations
        RateLimiter::for(name: 'api-writing', callback: static function (Request $request) {
            return Limit::perMinute(maxAttempts: 5)->by(key: $request->user()?->id ?: $request->ip());
        });

        // RateLimiter For Reading Operations
        RateLimiter::for(name: 'api-reading', callback: static function (Request $request) {
            return Limit::perMinute(maxAttempts: 30)->by(key: $request->user()?->id ?: $request->ip());
        });
    }
}
