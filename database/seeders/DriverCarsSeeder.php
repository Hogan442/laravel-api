<?php

namespace Database\Seeders;

use App\Models\DriverCars;
use Illuminate\Database\Seeder;

class DriverCarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DriverCars::factory()
            ->count(50)
            ->hasCars(1)
            ->hasDrivers(1)
            ->create();
    }
}
