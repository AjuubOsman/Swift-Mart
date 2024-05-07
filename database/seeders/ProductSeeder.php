<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('products')->insert([
            ['id' => 1,
                'name' => 'Iphone',
                'description' => 'Blauwe Iphone',
                'price' => 100.99,
                'inventory' => 12,
                'category_id' => 1,
            ],
            ['id' => 2,
                'name' => 'TV',
                'description' => 'Samsung',
                'price' => 800.99,
                'inventory' => 5,
                'category_id' => 2,
            ],
        ]);
    }
}
