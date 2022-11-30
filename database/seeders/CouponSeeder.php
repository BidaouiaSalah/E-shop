<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            "code" => "1234a",
            "type" => "fixed",
            "value" => "20",
        ]);
        Coupon::create([
            "code" => "123b",
            "type" => "percent",
            "value" => "456b",
        ]);
    }
}
