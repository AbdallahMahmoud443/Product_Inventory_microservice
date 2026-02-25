<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->as('v1.')->group(static  function () {
    Route::prefix('products')->as('products.')->group(static function () {
        require base_path('routes/api/v1/product.php');
        require base_path('routes/api/v1/stock.php');
    });
});
