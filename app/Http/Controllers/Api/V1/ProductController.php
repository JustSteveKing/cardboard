<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Auth\ProductRequest;
use App\Http\Resources\Api\V1\ProductResource;
use App\Models\Product;

class ProductController
{
    public function __invoke(ProductRequest $request)
    {
        $productUuid = $request->get('uuid');

        $product = Product::where('uuid', $productUuid)->get()->first();

        abort_if(auth()->user()->cannot('view', $product), 403);

        return ProductResource::collection(Product::where('uuid', $productUuid)->get());
    }
}
