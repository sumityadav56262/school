<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=MiscExpense>
 */
class MiscExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'particular' => fake()->sentence(3),
            'amount' => fake()->randomFloat(2, 10, 5000),
            'payment_by' => fake()->name(),
            'payment_date' => fake()->date(),
            'remark' => fake()->optional()->sentence(6),
        ];
    }
}
