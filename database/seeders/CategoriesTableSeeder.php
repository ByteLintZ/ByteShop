<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Electronics']);
        Category::create(['name' => 'Books']);
        Category::create(['name' => 'Clothing']);
        Category::create(['name' => 'Home & Kitchen']);
        Category::create(['name' => 'Sports & Outdoors']);
    }
}


