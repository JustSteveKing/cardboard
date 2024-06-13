<?php

namespace App\Http\Resources\Api\V1;

use App\Enums\ProductCategories;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'type' => ProductCategories::CARD->value,
            'attributes' => [
                'name' => $this->name,
                'image_path' => $this->image_path,
                'latest_prices' => [
                    'nonfoil' => $this->getLatestPrice(1),
                    'foil' => $this->getLatestPrice(2),
                    'etched' => $this->getLatestPrice(3),
                ],
            ],
            // 'links' =>
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
