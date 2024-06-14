<?php

declare(strict_types=1);

use App\Http\Controllers\Api\V1\Auth;
use App\Http\Middleware\LogAPIRequests;
use Illuminate\Support\Facades\Route;

Route::post('/register', Auth\RegisterController::class)->name('v1.register');

Route::post('/login', Auth\LoginController::class)->name('v1.login');

Route::middleware(['auth:sanctum', LogAPIRequests::class])->group(function (): void {

    Route::get('/user', static fn () => request()->user());

    Route::prefix('v1')->group(base_path('routes/api/v1.php'));

});
