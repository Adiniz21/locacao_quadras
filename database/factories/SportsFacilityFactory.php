<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{SportsFacility, Venue, User};

class SportsFacilityFactory extends Factory
{
    protected $model = SportsFacility::class;

    public function definition(): array
    {
        return [
            'venue_id'     => Venue::factory(),
            'owner_id'     => User::factory(),
            'name'         => 'Quadra '.$this->faker->word(),
            'type'         => $this->faker->randomElement(['futsal','volleyball','soccer','badminton','basketball','tennis']),
            'capacity'     => $this->faker->numberBetween(10, 50),
            'hourly_price' => $this->faker->randomFloat(2, 50, 300),
            'availability' => true,
            'city'         => $this->faker->city(),
            'address'      => $this->faker->streetAddress(),
        ];
    }
}
