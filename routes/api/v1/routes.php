<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::middleware(['cache.headers:public;max_age=2628000;etag'])->prefix('products')->as('products:')->group(base_path(
    path: 'routes/api/v1/products.php',
));
