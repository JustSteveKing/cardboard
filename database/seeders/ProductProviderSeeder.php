<?php

namespace Database\Seeders;

use App\Enums\ProductProviders;
use App\Models\ProductProvider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ProductProviders::cases() as $provider) {

            ProductProvider::factory()->create([
                'name' => ucwords($provider->value),
                'slug' => Str::slug($provider->value),
            ]);
        }

    }
}
