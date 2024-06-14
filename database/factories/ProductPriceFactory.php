<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProductFinishes;
use App\Models\Product;
use App\Models\ProductFinish;
use App\Models\ProductPrice;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class ProductPriceFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = ProductPrice::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'price' => $this->faker->numberBetween(
                int2: 10_000,
            ),
            'product_id' => Product::factory(),
            'finish' => ProductFinishes::NONFOIL,
        ];
    }
}
