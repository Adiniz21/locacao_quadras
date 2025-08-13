<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SportsFacility;
class SportsFacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SportsFacility::factory()
        ->count(5)
        ->create();
    }
}
