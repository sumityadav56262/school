<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_card_no' => fake()->unique()->numberBetween(1000, 9999),
            'teacher_name' => fake()->name(),
            'designation' => fake()->randomElement([
                'Head Teacher',
                'Assistant Teacher',
                'Subject Teacher',
                'Computer Teacher',
                'Sports Teacher',
            ]),
            'mobile_no' => fake()->numerify('98########'),  // Nepali mobile format
            'address' => fake()->address(),
        ];
    }
}
