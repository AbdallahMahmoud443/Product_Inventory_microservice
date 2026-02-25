<?php

namespace App\Providers;

use App\repositories\v1\stock\interfaces\StockInterfaceRepository;
use App\repositories\v1\stock\StockRepository;
use App\services\v1\stock\interfaces\StockInterfaceService;
use App\services\v1\stock\StockService;
use Illuminate\Support\ServiceProvider;

class StockServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(StockInterfaceRepository::class, StockRepository::class);
        $this->app->bind(StockInterfaceService::class, StockService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
