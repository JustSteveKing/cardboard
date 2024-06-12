<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductFinish;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductPrice>
 */
class ProductPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => rand(0, 100000),
            'product_id' => Product::all()->random()->id,
            'product_finish_id' => ProductFinish::all()->random()->id,
        ];
    }
}
