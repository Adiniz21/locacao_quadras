<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SportsFacilities;

class SportsFacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SportsFacilities::factory()
            ->count(5)
            ->create();
    }
}
