<?php

namespace Database\Seeders;

use App\Enums\ProductProviders;
use App\Models\ProductProvider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProductProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provider = Arr::random(ProductProviders::cases())?->value;

        ProductProvider::factory()->create([
            'name' => ucwords($provider),
            'slug' => Str::slug($provider),
        ]);
    }
}
