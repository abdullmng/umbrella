<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Digital Marketting',
                "slug" => "DM",
                'duration' => 72,
                'amount' => 5000.00,
                'earning_rate' => 200.00
            ],
            [
                'name' => 'Advance Crypto Trading',
                "slug" => "ACT",
                'duration' => 72,
                'amount' => 5000.00,
                'earning_rate' => 200.00
            ],
            [
                'name' => 'Web Development With PHP and MySQL',
                "slug" => "WDPHPSQL",
                'duration' => 72,
                'amount' => 5000.00,
                'earning_rate' => 200.00
            ]
        ];
        Course::insert($courses);
    }
}
