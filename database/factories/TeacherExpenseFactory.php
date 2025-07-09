<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Teacher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=TeacherExpense>
 */
class TeacherExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a random teacher id_card_no
        $teacherIdCard = Teacher::inRandomOrder()->value('id_card_no');

        $salary = fake()->numberBetween(20000, 60000);
        $paid = fake()->numberBetween(0, $salary);
        $due = $salary - $paid;

        return [
            'id_card_no' => $teacherIdCard,
            'salary_amt' => $salary,
            'paid_amt' => $paid,
            'due_amt' => $due,
            'paid_by' => fake()->name(),
            'paid_date' =>  function () {
                $year = rand(2075, 2085);
                $month = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT);
                $day = str_pad(rand(1, 32), 2, '0', STR_PAD_LEFT);
                return "{$day}/{$month}/{$year}";
            },
            'remark' => fake()->optional()->sentence(),
        ];
    }
}
