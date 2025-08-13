<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Reservation, SportsFacility, User};
use Illuminate\Support\Carbon;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        // data e hora coerentes
        $date  = Carbon::parse($this->faker->dateTimeBetween('+1 day', '+1 month'))->toDateString();
        $start = Carbon::createFromTime($this->faker->numberBetween(8, 21), [0,30][rand(0,1)]);
        $end   = (clone $start)->addMinutes([60,90,120][rand(0,2)]);

        return [
            'sports_facilities_id' => SportsFacility::factory(),
            'user_id'              => User::factory(),
            'reservation_date'     => $date,
            'start_time'           => $start->format('H:i:s'),
            'end_time'             => $end->format('H:i:s'),
            'total_price'          => $this->faker->randomFloat(2, 50, 300),
            'payment_status'       => $this->faker->randomElement(['confirmed','paid','pending']),
            'recurrence'           => 'none',
            'notification_sent'    => false,
        ];
    }
}
