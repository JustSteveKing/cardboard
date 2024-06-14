<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\ProductResource;
use App\Models\Product;

class ProductsController
{
    public function __invoke()
    {
        return ProductResource::collection(Product::paginate(100));
    }
}
