<?php

namespace Database\Factories;

use App\Models\Detail;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Driver;


class DriverFactory extends Factory
{

    protected $model = Driver::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'id_number' => $this->faker->unique()->randomNumber(7),
            'phone_number' => $this->faker->unique()->randomNumber(8),
        ];
    }
}
