<?php

namespace Database\Seeders;

use App\Models\Addons;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Category::factory(10)->create();

        Addons::factory(10)->create();

        Product::factory(30)->create();
    }
}
