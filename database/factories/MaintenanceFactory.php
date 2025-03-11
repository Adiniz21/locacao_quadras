<?php

namespace Database\Factories;

use App\Models\Maintenance;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Maintenance::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(15),
            ' scheduled_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['active', 'on_leave', 'terminated', 'retired']),
            'sports_facilities_id' => \App\Models\SportsFacilities::factory(),
        ];
    }
}
