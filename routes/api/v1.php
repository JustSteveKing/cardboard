<?php

use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ProductsController;
use Illuminate\Support\Facades\Route;

Route::post('/products', ProductsController::class)->name('v1.products');

Route::post('/product', ProductController::class)->name('v1.product');
