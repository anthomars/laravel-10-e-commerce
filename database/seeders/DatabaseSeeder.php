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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            'name' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'usertype' => '1',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::create([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'usertype' => '0',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Product::create([
            'product_name' => 'Advan Workpro',
            'product_descriptions' => 'Intel I5 14'' FHD IPS 8GB 256GB Win 11',
            'photo' => 'products/workpro.jpg',
            'price' => '5000000',
        ]);

        \App\Models\Product::create([
            'product_name' => 'Advan Workplus',
            'product_descriptions' => 'AMD RYZEN 5 6600H 14''',
            'photo' => 'products/workplus.jpg',
            'price' => '7000000',
        ]);
    }
}
