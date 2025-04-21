<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Smartphone',
            'price' => 299.99,
            'stock' => 50,
            'category_id' => 1,
            'image' => 'img1',
            'description' => 'A high-end smartphone with a sleek design.'
        ]);

        Product::create([
            'name' => 'Laptop',
            'price' => 999.99,
            'stock' => 30,
            'category_id' => 1,
            'image' => 'img2',
            'description' => 'A powerful laptop for all your computing needs.'
        ]);

        Product::create([
            'name' => 'T-shirt',
            'price' => 19.99,
            'stock' => 100,
            'category_id' => 3,
            'image' => 'img3',
            'description' => 'A comfortable cotton T-shirt.'
        ]);

        Product::create([
            'name' => 'Blender',
            'price' => 49.99,
            'stock' => 20,
            'category_id' => 4,
            'image' => 'img4',
            'description' => 'A high-performance blender for smoothies and soups.'
        ]);

        Product::create([
            'name' => 'Running Shoes',
            'price' => 79.99,
            'stock' => 40,
            'category_id' => 5,
            'image' => 'img5',
            'description' => 'Lightweight running shoes for everyday use.'
        ]);
    }
}
