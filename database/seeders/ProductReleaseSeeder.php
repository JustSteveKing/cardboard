<?php

namespace Database\Seeders;

use App\Models\ProductRelease;
use Illuminate\Database\Seeder;

class ProductReleaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductRelease::factory(10)->create();
    }
}
