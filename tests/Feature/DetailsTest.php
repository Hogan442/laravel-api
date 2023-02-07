<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DetailsTest extends TestCase
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
        "id_number" => 9025199085,
        "phone_number" => 692118815,
        "first_name" => "Hogan",
        "last_name" => "Fortuin",
        "home_address" => "84, 9th Ave Leonsdale",
        "license_type" => "A"
    ];

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getting_all_details()
    {
        $response = $this->get('/api/details');

        $response->assertStatus(200);
    }

 
    public function test_delete_drivers_detail() {


        // Post a new driver
        $this->postJson('api/drivers', $this->data);


        // Get one drivers detail
        $response = $this->getJson('/api/drivers/51');
        $response->assertStatus(200);

        $response->assertJson(
            [
                'status' => 'OK',
                'success' => true,
                'message' => "",
                'data' => [
                    "id_number" => 9025199085,
                    "phone_number" => 692118815,
                    'details' => [
                        'first_name' => 'Hogan',
                        'last_name' => 'Fortuin',
                    ]
                ]
            ]
        );

        // Drivers details should be deleted
        $response = $this->deleteJson('/api/drivers/51/details');
        $response->assertStatus(200);



        // Get the driver whose details was deleted
        $response = $this->getJson('/api/drivers/51');

        $response->assertJson([
            'status' => 'OK',
            'success' => true,
            'data' => [
                'details' => null
            ]
        ]);
    }



    public function test_delete_non_existing_driver() {

        // Drivers details should not be deleted
        $response = $this->deleteJson('/api/drivers/51/details');
        $response->assertStatus(400);

        $response->assertJson([
            'status' => 'ERROR',
            'success' => false,
            'message' => 'Driver does not exist',
            'data' => [
            ]
        ]);

    }



    public function test_edit_drivers_details() {

        // Post a new driver
        $this->postJson('api/drivers', $this->data);


        // Check that the newly posted driver was succesfully posted
        $response = $this->getJson('/api/drivers/51');
        $response->assertStatus(200);

        $response->assertJson(
            [
                'status' => 'OK',
                'success' => true,
                'message' => "",
                'data' => [
                    "id_number" => 9025199085,
                    "phone_number" => 692118815,
                    'details' => [
                        'first_name' => 'Hogan',
                        'last_name' => 'Fortuin',
                    ]
                ]
            ]
        );


        // Edit the drivers details
        $new_data = [
            'driver_id' => 51,
            "first_name" => "Luke",
        ];
        $response = $this->patchJson('/api/drivers/51', $new_data);

        $response->assertJson(
            [
                'status' => 'OK',
                'success' => true,
                'message' => "Driver has been updated",
                'data' => [
                    'first_name' => 'Luke',
                ]
            ]
        );

    }


}
