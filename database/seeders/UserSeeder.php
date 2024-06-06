<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('users')->insert([
            ['id' => 1,
                'name' => 'ajuub',
                'email' => 'ajuub2003@gmail.com',
                'password' => bcrypt('welkom'),
                'street' => 'klaverkamp 50',
                'city' => 'elst',
                'zipcode' => '6662RZ',
                'country' => 'netherland',
                'isadmin' => '1',
            ],
            ['id' => 2,
                'name' => 'ajuub',
                'email' => 'klant@gmail.com',
                'password' => bcrypt('welkom'),
                'street' => 'klaverkamp 50',
                'city' => 'elst',
                'zipcode' => '6662RZ',
                'country' => 'netherland',
                'isadmin' => '0',
            ],
        ]);
    }
}
