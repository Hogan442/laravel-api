<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\Driver;
use App\Models\driver_cars;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverCarsFactory extends Factory
{

    protected $model = driver_cars::class;
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
            'license_plate' => $this->faker->realText(7),
            'insured' => $this->faker->boolean(50),
            'last_service' => $this->faker->dateTimeThisDecade()
        ];
    }
}
