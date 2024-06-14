<?php

use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/products', ProductsController::class)->name('v1.products');

Route::get('/product', ProductController::class)->name('v1.product');
