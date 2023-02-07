<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Driver;
use App\Models\DriverCars;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverCarsFactory extends Factory
{

    protected $model = DriverCars::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'driver_id' => Driver::factory(),
            'car_id' => Car::factory(),
            'license_plate' => $this->faker->unique()->text(7),
            'insured' => $this->faker->boolean(5),
            'last_service' => $this->faker->dateTime('now')
        ];
    }
}
