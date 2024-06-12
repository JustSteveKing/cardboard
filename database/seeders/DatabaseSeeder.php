<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //See DX.md for seeing guide

        $this->call([
            ProductCategorySeeder::class,
            ProductFranchiseSeeder::class,
            ProductProviderSeeder::class,
            ProductFinishSeeder::class,
            ProductReleaseSeeder::class,
            // ProductSeeder::class,
            // ProductPriceSeeder::class,
        ]);
    }
}
