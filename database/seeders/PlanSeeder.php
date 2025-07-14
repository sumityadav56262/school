<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plans as Plan;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::insert([
            [
                'name' => 'Free Trial (30 days)',
                'duration_months' => 1,
                'price_per_month' => 0,
                'discount_percent' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '1 Month',
                'duration_months' => 1,
                'price_per_month' => 200,
                'discount_percent' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '6 Months',
                'duration_months' => 6,
                'price_per_month' => 200,
                'discount_percent' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '1 Year',
                'duration_months' => 12,
                'price_per_month' => 200,
                'discount_percent' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}

