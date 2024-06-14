<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\ProductResource;
use App\Models\Product;

class ProductsController
{
    public function __invoke()
    {
        abort_if(auth()->user()->cannot('viewAny', Product::class), 403);

        return ProductResource::collection(Product::paginate(100));
    }
}
