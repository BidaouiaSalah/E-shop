<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            "id" => 6,
            "name" => "OPPO",
        ]);
        Brand::create([
            "id" => 7,
            "name" => "IPhone 11 Pro",
        ]);
        Brand::create([
            "id" => 8,
            "name" => "TCL",
        ]);
        Brand::create([
            "id" => 10,
            "name" => "Dell",
        ]);
    }
}
