<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\StudClass;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=StudentFee>
 */
class StudentFeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nepaliDate =  function () {
            $year = rand(2075, 2085);
            $month = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
            $day = str_pad(rand(1, 32), 2, '0', STR_PAD_LEFT);
            return "{$day}/{$month}/{$year}";
        };


        return [
            'emis_no' => Student::inRandomOrder()->value('emis_no')
                ?? fake()->unique()->regexify('EMIS_[0-9]{5}'),

            'payment_date' =>  $nepaliDate(),
            'admission_date' => $nepaliDate(),
            'month_name' => fake()->monthName(),
            'yearly_fee' => fake()->numberBetween(500, 5000),
            'monthly_fee' => fake()->numberBetween(500, 5000),
            'eca_fee' => fake()->numberBetween(0, 500),
            'game_fee' => fake()->numberBetween(0, 500),
            'misc_fee' => fake()->numberBetween(0, 500),
            'exam_fee' => fake()->numberBetween(0, 500),
            'tie_belt_fee' => fake()->numberBetween(0, 200),
            'vest_fee' => fake()->numberBetween(0, 200),
            'computer_fee' => fake()->numberBetween(0, 500),
            'trouser_fee' => fake()->numberBetween(0, 300),

            'total_amt' => fake()->numberBetween(2000, 15000),
            'discount_amt' => fake()->numberBetween(0, 1000),
            'payment_amt' => fake()->numberBetween(500, 10000),
            'dues_amt' => fake()->numberBetween(0, 5000),

            'payment_by' => fake()->name(),
            'received_by' => fake()->name(),

            'recurring_dues' => fake()->optional()->numberBetween(100, 1000),
        ];
    }
}
