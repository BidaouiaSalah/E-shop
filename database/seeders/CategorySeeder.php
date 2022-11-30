<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "id" => 1,
            "name" => "Tv's",
        ]);
        Category::create([
            "id" => 2,
            "name" => "Accessories",
        ]);
        Category::create([
            "id" => 3,
            "name" => "Laptops",
        ]);
        Category::create([
            "id" => 4,
            "name" => "Phones",
        ]);
    }
}
