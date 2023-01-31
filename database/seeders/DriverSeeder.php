<?php

namespace Database\Seeders;
// namespace Database\Factories;

use App\Models\Driver;
use Database\Factories\DriverFactory;
use Illuminate\Database\Seeder;


class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Driver::factory()
            ->count(50)
            ->hasDetail(1)
            ->DriverCars(1)
            ->create();

    }
}
