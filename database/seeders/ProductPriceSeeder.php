<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ProductPrice;
use Illuminate\Database\Seeder;

final class ProductPriceSeeder extends Seeder
{
    public function run(): void
    {
        ProductPrice::factory()->count(1_000)->create();
    }
}
