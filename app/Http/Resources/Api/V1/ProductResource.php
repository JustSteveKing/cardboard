<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use App\Enums\ProductCategories;
use App\Models\Product;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read Product $resource
 */
final class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->resource->uuid,
            'type' => ProductCategories::CARD->value,
            'attributes' => [
                'name' => $this->resource->name,
                'image_path' => $this->resource->image_path,
                'set_code' => $this->resource->release->code,
                'set_name' => $this->resource->release->name,
                'latest_prices' => [
                    'nonfoil' => $this->getLatestPrice(1),
                    'foil' => $this->getLatestPrice(2),
                    'etched' => $this->getLatestPrice(3),
                ],
            ],
            'links' => [
                'self' => route('v1:products:show', $this->resource->uuid),
                'parent' => route('v1:products:index'),
            ],
        ];
    }

    protected function getLatestPrice(int $finishId): ?array
    {
        $productPrice = ProductPrice::mostRecentForFinish($this->id, $finishId)->first();

        if ($productPrice) {
            return [
                'price' => $productPrice->price,
                'created_at' => $productPrice->created_at,
            ];
        }

        return null;
    }
}
