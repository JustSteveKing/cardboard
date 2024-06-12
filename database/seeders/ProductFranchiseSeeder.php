<?php

namespace Database\Seeders;

use App\Enums\ProductFranchises;
use App\Models\ProductFranchise;
use Illuminate\Database\Seeder;

class ProductFranchiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ProductFranchises::cases() as $franchise) {
            ProductFranchise::factory()->create([
                'name' => ucwords($franchise->value),
                'slug' => $franchise->value,
            ]);
        }
    }
}
