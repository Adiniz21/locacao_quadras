<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Venue, User};

class VenueFactory extends Factory
{
    protected $model = Venue::class;

    public function definition(): array
    {
        return [
            'owner_id' => User::factory(),
            'name'     => 'Arena '.$this->faker->company(),
            'city'     => $this->faker->city(),
            'address'  => $this->faker->address(),
        ];
    }
}
