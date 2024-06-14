<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Resources\Api\V1\ProductResource;
use App\Http\Responses\API\V1\ModelResponse;
use App\Models\Product;
use Illuminate\Http\Request;

final class ShowController
{
    public function __invoke(Request $request, string $uuid)
    {
        $product = Product::query()->where(
            column: 'uuid',
            operator: '=',
            value: $uuid,
        )->firstOrFail();

        return new ModelResponse(
            data: new ProductResource($product),
            key: 'product',
        );
    }
}
