<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Reservation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserReservationsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_user_reservations(): void
    {
        $user = User::factory()->create();
        $reservations = Reservation::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(
            route('api.users.reservations.index', $user)
        );

        $response->assertOk()->assertSee($reservations[0]->reservation_date);
    }

    /**
     * @test
     */
    public function it_stores_the_user_reservations(): void
    {
        $user = User::factory()->create();
        $data = Reservation::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.reservations.store', $user),
            $data
        );

        unset($data['sports_facilities_id']);
        unset($data['user_id']);
        unset($data['reservation_date']);
        unset($data['start_time']);
        unset($data['end_time']);
        unset($data['total_price']);
        unset($data['payment_status']);
        unset($data['recurrence']);
        unset($data['notification_sent']);

        $this->assertDatabaseHas('reservations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $reservation = Reservation::latest('id')->first();

        $this->assertEquals($user->id, $reservation->user_id);
    }
}
