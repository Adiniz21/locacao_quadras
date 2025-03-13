<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Employees;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeesControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_all_employees(): void
    {
        $allEmployees = Employees::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-employees.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_employees.index')
            ->assertViewHas('allEmployees');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_employees(): void
    {
        $response = $this->get(route('all-employees.create'));

        $response->assertOk()->assertViewIs('app.all_employees.create');
    }

    /**
     * @test
     */
    public function it_stores_the_employees(): void
    {
        $data = Employees::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-employees.store'), $data);

        $this->assertDatabaseHas('employees', $data);

        $employees = Employees::latest('id')->first();

        $response->assertRedirect(route('all-employees.edit', $employees));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_employees(): void
    {
        $employees = Employees::factory()->create();

        $response = $this->get(route('all-employees.show', $employees));

        $response
            ->assertOk()
            ->assertViewIs('app.all_employees.show')
            ->assertViewHas('employees');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_employees(): void
    {
        $employees = Employees::factory()->create();

        $response = $this->get(route('all-employees.edit', $employees));

        $response
            ->assertOk()
            ->assertViewIs('app.all_employees.edit')
            ->assertViewHas('employees');
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

        $response = $this->put(
            route('all-employees.update', $employees),
            $data
        );

        $data['id'] = $employees->id;

        $this->assertDatabaseHas('employees', $data);

        $response->assertRedirect(route('all-employees.edit', $employees));
    }

    /**
     * @test
     */
    public function it_deletes_the_employees(): void
    {
        $employees = Employees::factory()->create();

        $response = $this->delete(route('all-employees.destroy', $employees));

        $response->assertRedirect(route('all-employees.index'));

        $this->assertModelMissing($employees);
    }
}
