<?php

namespace Database\Seeders;

use App\Enums\ProductCategories;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ProductCategories::cases() as $category) {
            ProductCategory::factory()->create([
                'name' => ucwords($category->value),
                'slug' => $category->value,
            ]);
        }
    }
}
