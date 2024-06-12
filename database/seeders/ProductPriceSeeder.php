<?php

namespace Database\Seeders;

use App\Models\ProductPrice;
use Illuminate\Database\Seeder;

class ProductPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductPrice::factory(1000)->create();
    }
}
