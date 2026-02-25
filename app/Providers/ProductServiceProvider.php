<?php

namespace App\Providers;

use App\repositories\v1\product\interfaces\ProductInterfaceRepository;
use App\repositories\v1\product\ProductRepository;
use App\services\v1\product\interfaces\ProductInterfaceService;
use App\services\v1\product\ProductService;
use Illuminate\Support\ServiceProvider;


class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ProductInterfaceRepository::class, ProductRepository::class);
        $this->app->bind(ProductInterfaceService::class, ProductService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
