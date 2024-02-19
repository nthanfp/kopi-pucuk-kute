<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\ProductSeeder as SeedersProductSeeder;
use Illuminate\Database\Seeder;
use ProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // SeedersProductSeeder::class,
            WebProfileSeeder::class,
        ]);
    }
}
