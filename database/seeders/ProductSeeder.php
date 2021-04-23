<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Wear
        DB::table('products')->insert([
            'name' => 'Sunglasses',
            'price' => 5000,
            'image' => '/img/sunglasses.jpg',
            'count' => 200,
            'category_id' => 1,
        ]);
        DB::table('products')->insert([
            'name' => 'T-shirt',
            'price' => 10000,
            'image' => '/img/t-shirt.jpg',
            'count' => 50,
            'category_id' => 1,
        ]);
        DB::table('products')->insert([
            'name' => 'Socks',
            'price' => 500,
            'image' => '/img/socks.jpg',
            'count' => 1000,
            'category_id' => 1,
        ]);

        // Cars
        DB::table('products')->insert([
            'name' => 'Toyota',
            'price' => 5000000,
            'image' => '/img/toyota.jpg',
            'count' => 5,
            'category_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => 'BMW',
            'price' => 7000000,
            'image' => '/img/bmw.jpg',
            'count' => 3,
            'category_id' => 2,
        ]);
        DB::table('products')->insert([
            'name' => 'Lada',
            'price' => 2000000,
            'image' => '/img/lada.jpg',
            'count' => 10,
            'category_id' => 2,
        ]);

        // Technics
        DB::table('products')->insert([
            'name' => 'Phone',
            'price' => 100000,
            'image' => '/img/phone.jpg',
            'count' => 20,
            'category_id' => 3,
        ]);
        DB::table('products')->insert([
            'name' => 'Headphones',
            'price' => 20000,
            'image' => '/img/headphones.jpg',
            'count' => 50,
            'category_id' => 3,
        ]);
        DB::table('products')->insert([
            'name' => 'Adapter',
            'price' => 500,
            'image' => '/img/adapter.jpg',
            'count' => 100,
            'category_id' => 3,
        ]);
    }
}
