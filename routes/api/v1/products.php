<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Products;
use Illuminate\Support\Facades\Route;

Route::get('/', Products\IndexController::class)->name('index');
Route::get('{uuid}', Products\ShowController::class)->name('show');
