<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            "id" => 44,
            "name" => "iPhone 100",
            "description" => "An apple mobile which is nothing like apple",
            "details" => "An apple mobile which is nothing like apple",
            "price" => 549,
            "stock" => 94,
            "brand_id" => 1,
            "slug" => "t-shirts",
            "category_id" => 1,
        ]);
        Product::create([
            "id" => 15,
            "name" => "iPhone 9",
            "details" => "An apple mobile which is nothing like apple",
            "description" => "An apple mobile which is nothing like apple",
            "price" => 549,
            "stock" => 94,
            "brand_id" => 2,
            "slug" => "pants",
            "category_id" => 3,
        ]);
        Product::create([
            "id" => 75,
            "name" => "iPhone hdw",
            "details" => "An apple mobile which is nothing like apple",
            "description" => "An apple mobile which is nothing like apple",
            "price" => 549,
            "stock" => 94,
            "brand_id" => 10,
            "slug" => "iphone",
            "category_id" => 4,
        ]);
    }
}
