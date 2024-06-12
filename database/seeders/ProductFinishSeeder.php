<?php

namespace Database\Seeders;

use App\Enums\ProductFinishes;
use App\Models\ProductFinish;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductFinishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (ProductFinishes::cases() as $finish) {
            $finish = $finish->value;

            ProductFinish::factory()->create([
                'name' => ucwords($finish),
                'slug' => Str::slug($finish),
            ]);
        }
    }
}
