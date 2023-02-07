<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{

    protected $model = Car::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vehicle_make' => $this->faker->randomElement(['Golf', 'Toyota', 'Bentley', 'Ford', 'Honda']),
            'vehicle_model' => $this->faker->name(),
            'model_year' => $this->faker->year('now'),
            'passenger_capacity' => $this->faker->numberBetween(1, 11)
        ];
    }
}
