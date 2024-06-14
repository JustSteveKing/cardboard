<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ProductRelease;
use Illuminate\Database\Seeder;

final class ProductReleaseSeeder extends Seeder
{
    public function run(): void
    {
        ProductRelease::factory()->count(10)->create();
    }
}
