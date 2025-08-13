<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Payment, Reservation};

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'reservation_id' => Reservation::factory(),
            'amount'         => $this->faker->randomFloat(2, 50, 300),
            'status'         => $this->faker->randomElement(['pending','paid','failed','refunded']),
            'method'         => $this->faker->randomElement(['pix','card','cash']),
            'paid_at'        => null,
        ];
    }
}
