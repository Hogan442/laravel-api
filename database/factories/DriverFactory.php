<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


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
            'id_number' => $this->faker->unique()->randomNumber(13),
            'phone_number' => $this->faker->unique()->phoneNumber()
        ];
    }
}
