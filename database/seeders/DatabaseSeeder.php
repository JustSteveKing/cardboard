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
        $this->call([
            ProductCategorySeeder::class,
            ProductFranchiseSeeder::class,
            ProductProviderSeeder::class,
            ProductFinishSeeder::class,

            // See dx.md for seeding guide
            // ProductReleaseSeeder::class,
            // ProductSeeder::class,
        ]);
    }
}
