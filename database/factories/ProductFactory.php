<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\ProductCategories;
use App\Enums\ProductFranchises;
use App\Models\Product;
use App\Models\ProductRelease;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class ProductFactory extends Factory
{
    /** @var class-string<Model> */
    protected $model = Product::class;

    /** @return array<string,mixed> */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'external_id' => $this->faker->uuid(),
            'image_path' => $this->faker->imageUrl(),
            'category' => ProductCategories::CARD,
            'franchise' => ProductFranchises::MAGIC,
            'product_release_id' => ProductRelease::factory(),
        ];
    }
}
