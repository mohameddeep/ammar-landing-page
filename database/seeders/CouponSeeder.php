<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [];

        for ($i = 1; $i <= 15; $i++) {
            $coupons[] = [
                'code' => strtoupper(Str::random(8)),
                'name' => 'Coupon ' . $i,
                'discount' => rand(5, 50),
                'usage_count' => rand(0, 100),
                'expire_at' => Carbon::now()->addDays(rand(1, 100)),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('coupons')->insert($coupons);
    }
}
