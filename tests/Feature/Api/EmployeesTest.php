<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Employees;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeesTest extends TestCase
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
    public function it_gets_all_employees_list(): void
    {
        $allEmployees = Employees::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-employees.index'));

        $response->assertOk()->assertSee($allEmployees[0]->hired_date);
    }

    /**
     * @test
     */
    public function it_stores_the_employees(): void
    {
        $data = Employees::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-employees.store'), $data);

        $this->assertDatabaseHas('employees', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_employees(): void
    {
        $employees = Employees::factory()->create();

        $user = User::factory()->create();

        $data = [
            'position' => '',
            'salary' => $this->faker->randomNumber(1),
            'hired_date' => $this->faker->date(),
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.all-employees.update', $employees),
            $data
        );

        $data['id'] = $employees->id;

        $this->assertDatabaseHas('employees', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_employees(): void
    {
        $employees = Employees::factory()->create();

        $response = $this->deleteJson(
            route('api.all-employees.destroy', $employees)
        );

        $this->assertModelMissing($employees);

        $response->assertNoContent();
    }
}
