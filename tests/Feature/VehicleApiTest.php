<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VehicleApiTest extends TestCase
{
    /**
    * Seeding in memory db
    
    */
    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate');
        $this->artisan('db:seed');
    }

    public function tearDown(): void
    {
        $this->artisan('migrate:reset');
    }

    protected $data = [
        'vehicle_make' => 'Honda',
        'vehicle_model' => 'V-Tech',
        'model_year' => 2022,
        'passenger_capacity' => 4,
        'insured' => true,
        'last_service' => "2022-06-25",
        'license_plate' => "CA80076",
        'driver_id' => 1
    ];


    /**
     * A basic feature test example.
     *
     * @return voidRoute::post('vehicle', 'App\Http\Controllers\Api\V1\CarController@store');
     */
    public function test_get_all_vehicles()
    {
        $response = $this->getJson('http://127.0.0.1:8000/api/vehicles');
        $response->assertStatus(200);

        $response->assertJson([
            'status' => 'OK',
            'success' => true,
            'message' => 'All the vehicles',

        ]);
    }

    public function test_add_new_vehicle() {
        
        $response = $this->postJson('http://127.0.0.1:8000/api/vehicles', $this->data);
        $response->assertStatus(202);

        $response->assertJson([
            'status' => 'OK',
            'success' => true,
            'message' => 'Vehicle was created!',
            'data' => [
                'vehicle_make' => 'Honda',
                'vehicle_model' => 'V-Tech',
                'model_year' => 2022,
                'passenger_capacity' => 4,
                'insured' => true,
                'last_service' => '2022-06-25',
                'license_plate' => 'CA80076',
                'driver_id' => 1,
            ]

        ]);

    }


    public function test_delete_vehicle() {

        $response = $this->getJson('http://127.0.0.1:8000/api/vehicles/1');
        $response->assertStatus(200);

        $response = $this->deleteJson('http://127.0.0.1:8000/api/vehicles/1');
        $response->assertStatus(200);

        $response = $this->getJson('http://127.0.0.1:8000/api/vehicles/1');
        $response->assertStatus(400);
    }


}
