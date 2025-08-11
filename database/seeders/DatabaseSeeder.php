<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(EmployeesSeeder::class);
        $this->call(MaintenanceSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(SportsFacilitiesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(\Database\Seeders\SampleDataSeeder::class);
    }
}
