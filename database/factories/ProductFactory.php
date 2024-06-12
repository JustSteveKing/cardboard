<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use App\Models\ProductFranchise;
use App\Models\ProductProvider;
use App\Models\ProductRelease;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'description' => fake()->sentence,
            'product_provider_external_id' => fake()->uuid,
            'image_path' => fake()->imageUrl,
            'product_category_id' => ProductCategory::all()->random()->id,
            'product_franchise_id' => ProductFranchise::all()->random()->id,
            'product_provider_id' => ProductProvider::all()->random()->id,
            'product_release_id' => ProductRelease::all()->random()->id,
        ];
    }
}
