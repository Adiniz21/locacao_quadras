<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SportsFacilities;
use Illuminate\Database\Eloquent\Factories\Factory;

class SportsFacilitiesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SportsFacilities::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(['futsal', 'volleyball', 'soccer', 'badminton', 'basketball', 'tennis']),
            'capacity' => $this->faker->randomNumber(0),
            'price_per_hour' => $this->faker->randomNumber(1),
            'availabilitiy' => $this->faker->boolean(),
        ];
    }
}
