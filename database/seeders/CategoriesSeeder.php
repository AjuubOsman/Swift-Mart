<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('categories')->insert([
            ['id' => 1,
                'name' => 'Phones',

            ],
            ['id' => 2,
                'name' => 'Electronics',
            ],
        ]);
    }
}
