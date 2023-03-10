<?php

namespace Database\Factories;

use App\Models\Detail;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailFactory extends Factory
{

    protected $model = Detail::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $driver = Driver::factory();
        return [
             'driver_id' => $this->faker->unique()->numberBetween(1, 50),
             'home_address' => $this->faker->address(),
             'first_name' => $this->faker->firstName(),
             'last_name' => $this->faker->lastName(),
             'license_type' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
             'last_trip' => $this->faker->dateTimeThisDecade('now')
        ];
    } 
}
