<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            [
                'code' => Str::random(10),
                'amount' => 5000.00,
                'status' => 'unused'
            ],
            [
                'code' => Str::random(10),
                'amount' => 5000.00,
                'status' => 'unused'
            ],
            [
                'code' => Str::random(10),
                'amount' => 5000.00,
                'status' => 'unused'
            ],
            [
                'code' => Str::random(10),
                'amount' => 5000.00,
                'status' => 'unused'
            ],
            [
                'code' => Str::random(10),
                'amount' => 5000.00,
                'status' => 'unused'
            ]    
        ];

        Coupon::insert($coupons);
    }
}
