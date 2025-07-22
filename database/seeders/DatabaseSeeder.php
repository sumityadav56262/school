<?php

namespace Database\Seeders;

use App\Models\StudClass;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $classNames = [
            'Nursery',
            'LKG',
            'UKG',
            'One',
            'Two',
            'Three',
            'Four',
            'Five',
            'Six',
            'Seven',
            'Eight',
            'Nine',
            'Ten',
        ];

        foreach ($classNames as $className) {
            StudClass::factory()->create([
                'class_name' => $className,
            ]);
        }
    }
}
