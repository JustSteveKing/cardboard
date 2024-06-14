<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Requests\Api\V1\ProductsRequest;
use App\Http\Resources\Api\V1\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

final class IndexController
{
    public function __invoke(ProductsRequest $request)
    {
        $collection = Product::with(
            relations: ['productPrices', 'productRelease'],
        )->when(
            value: $request->get('uuids'),
            callback: fn (Builder $query) => $query->whereIn(
                column: 'uuid',
                values: explode(',', $request->get('uuids')),
            ),
        )->simplePaginate(
            perPage: config('app.products_pagination_amount'),
        );

        return ProductResource::collection($collection);
    }
}
