<?php

namespace Database\Factories;

use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reservation_date' => $this->faker->date(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'total_price' => $this->faker->randomNumber(1),
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded', 'cancelled']),
            'recurrence' => $this->faker->randomElement(['none', 'daily', 'weekly', 'biweekly', 'monthly']),
            'notification_sent' => $this->faker->boolean(),
            'sports_facilities_id' => \App\Models\SportsFacilities::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
