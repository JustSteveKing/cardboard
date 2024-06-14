<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\ProductsRequest;
use App\Http\Resources\Api\V1\ProductResource;
use App\Models\Product;

class ProductsController
{
    public function __invoke(ProductsRequest $request)
    {
        abort_if(auth()->user()->cannot('viewAny', Product::class), 403);

        $collection = Product::with(['productPrices', 'productRelease'])
            ->when($request->uuids, fn ($query) => $query->whereIn('uuid', explode(',', $request->uuids)))
            ->simplePaginate(config('app.products_pagination_amount'));

        return ProductResource::collection($collection);
    }
}
