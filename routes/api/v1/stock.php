<?php

use App\Http\Controllers\v1\stock\AdjustStockQuantityController;
use App\Http\Controllers\v1\stock\ListProductWithThresholdController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:api-writing')->group(function () {
    Route::put('/{id}/stock', AdjustStockQuantityController::class)->name('adjust.stock');
});

Route::middleware('throttle:api-reading')->group(function () {
    Route::get('/low-stock', ListProductWithThresholdController::class)->name('get.stock');
});
