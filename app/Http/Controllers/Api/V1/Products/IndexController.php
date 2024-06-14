<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Requests\Api\V1\ProductsRequest;
use App\Http\Resources\Api\V1\ProductResource;
use App\Http\Responses\API\V1\CollectionResponse;
use App\Models\Product;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Eloquent\Builder;

final class IndexController
{
    public function __invoke(ProductsRequest $request): Responsable
    {
        $collection = Product::with(
            relations: ['prices', 'release'],
        )->when(
            value: $request->get('uuids'),
            callback: fn (Builder $query) => $query->whereIn(
                column: 'uuid',
                values: explode(',', $request->get('uuids')),
            ),
        )->simplePaginate(
            perPage: config('app.products_pagination_amount'),
        );

        return new CollectionResponse(
            data: ProductResource::collection($collection),
            key: 'products',
            headers: [],
        );
    }
}
