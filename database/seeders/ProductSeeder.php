<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Membuat 10 produk biji kopi
        for ($i = 1; $i <= 4; $i++) {
            $product = Product::create([
                'name' => 'Biji Kopi ' . $i,
                'description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            ]);

            // Membuat variant untuk setiap produk
            $variants = [
                ['name' => '100gr', 'price' => rand(60000, 100000), 'stock' => rand(10, 50), 'weight' => 0.1],
                ['name' => '250gr', 'price' => rand(100000, 200000), 'stock' => rand(10, 50), 'weight' => 0.25],
                ['name' => '500gr', 'price' => rand(200000, 300000), 'stock' => rand(10, 50), 'weight' => 0.5],
                ['name' => '1000gr', 'price' => rand(300000, 500000), 'stock' => rand(10, 50), 'weight' => 1],
            ];

            foreach ($variants as $variant) {
                $product->variants()->create($variant);
            }
        }
    }
}
