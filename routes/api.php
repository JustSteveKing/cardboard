<?php

use App\Http\Controllers\Api\V1\Auth\CreateTokenController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::post('/register', RegisterController::class)->name('v1.register');

Route::post('/token/create', CreateTokenController::class)->name('v1.token.create');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', fn () => request()->user());

    Route::prefix('v1')->group(base_path('routes/api/v1.php'));

});
