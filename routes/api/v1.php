<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Route;

Route::get('products', V1\Products\IndexController::class)->name('products:index');

Route::get('/product', V1\ProductController::class)->name('product');
