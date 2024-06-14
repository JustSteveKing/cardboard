<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Middleware\LogAPIRequests;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterController::class)->name('v1.register');

Route::post('/login', LoginController::class)->name('v1.login');

Route::middleware(['auth:sanctum', LogAPIRequests::class])->group(function () {

    Route::get('/user', fn () => request()->user());

    Route::prefix('v1')->group(base_path('routes/api/v1.php'));

});
