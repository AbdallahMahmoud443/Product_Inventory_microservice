<?php

use App\Http\Controllers\v1\product\CreateProductController;
use App\Http\Controllers\v1\product\GetProductController;
use App\Http\Controllers\v1\product\ListProductsController;
use App\Http\Controllers\v1\product\SoftDeleteProductController;
use App\Http\Controllers\v1\product\UpdateProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', ListProductsController::class)->name('list');
Route::get('/{id}', GetProductController::class)->name('show');
Route::post('/', CreateProductController::class)->name('create');
Route::put('/{id}', UpdateProductController::class)->name('update');
Route::delete('/{id}', SoftDeleteProductController::class)->name('soft.delete');
