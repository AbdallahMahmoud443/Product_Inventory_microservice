<?php

use App\Http\Controllers\v1\stock\AdjustStockQuantityController;
use App\Http\Controllers\v1\stock\ListProductWithThresholdController;
use Illuminate\Support\Facades\Route;

Route::post('/{id}/stock', AdjustStockQuantityController::class)->name('adjust.stock');
Route::get('products/low-stock', ListProductWithThresholdController::class)->name('get.stock');
