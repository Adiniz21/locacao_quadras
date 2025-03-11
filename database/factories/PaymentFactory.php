<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(1),
            'payment_method' => $this->faker->randomElement(['cash', 'credit_card', 'debit_card', 'pix', 'bank_transfer', 'boleto']),
            'status' => $this->faker->randomElement(['pending', 'paid', 'failed', 'refunded']),
            'transaction_date' => $this->faker->dateTime(),
            'reservation_id' => \App\Models\Reservation::factory(),
        ];
    }
}
