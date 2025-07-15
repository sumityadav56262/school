<?php

namespace Database\Factories;

use App\Models\StudClass;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'emis_no' => fake()->unique()->numerify('EMIS_#####'),
            'class_id' =>  StudClass::inRandomOrder()->value('id'),
            'stud_name' => fake()->name(),
            'roll_no' => fake()->numberBetween(1, 100),
            'father_name' => fake()->name('male'),
            'mobile_no' => fake()->numerify('98########'),
            'address' => fake()->address(),
        ];
    }
}
