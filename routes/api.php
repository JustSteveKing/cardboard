<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', fn () => request()->user());

    Route::prefix('v1')->group(base_path('routes/api/v1.php'));

});
