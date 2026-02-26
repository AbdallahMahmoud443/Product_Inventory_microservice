<?php

namespace App\Providers;

use App\Events\v1\stock\ProductWithLowThresholdEvent;
use App\Listeners\v1\stock\ProductWithLowThresholdAction;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        ProductWithLowThresholdEvent::class => [ProductWithLowThresholdAction::class],
    ];
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
        //
    }
}
