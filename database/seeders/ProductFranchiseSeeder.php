<?php

namespace Database\Seeders;

use App\Models\ProductFranchise;
use Illuminate\Database\Seeder;

class ProductFranchiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductFranchise::factory()->create([
            'name' => 'Magic: The Gathering',
            'slug' => 'magic-the-gathering',
        ]);
    }
}
