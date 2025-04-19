<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Inserting 30 products into the products table
        for ($i = 1; $i <= 30; $i++) {
            DB::table('products')->insert([
                'name' => 'Product ' . $i,
                'rfid_tag' => 'RFID' . rand(0000000, 9999999),
                'price' => rand(100, 1000),
                'size' => ['S', 'M', 'L', 'XL', 'XXL'][array_rand(['S', 'M', 'L', 'XL', 'XXL'])],
                'category' => ['Men', 'Women', 'Kid'][array_rand(['Men', 'Women', 'Kid'])],
                'type' => ['Top Wear', 'Bottom Wear'][array_rand(['Top Wear', 'Bottom Wear'])],
                'location' => ['Room A', 'Room B'][array_rand(['Room A', 'Room B'])],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
