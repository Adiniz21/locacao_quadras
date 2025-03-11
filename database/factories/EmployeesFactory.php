<?php

namespace Database\Factories;

use App\Models\Employees;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employees::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'position' => $this->faker->randomElement(['manager', 'referee', 'cleaner', 'staff']),
            'salary' => $this->faker->randomNumber(1),
            'hired_date' => $this->faker->date(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
