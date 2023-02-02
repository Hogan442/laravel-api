<?php

namespace Tests\Feature;

use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DriversApiTest extends TestCase
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



    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_drivers()
    {

        $response = $this->getJson('http://127.0.0.1:8000/api/drivers');
        $this->assertNotEmpty($response->json('data'));
        $response->assertStatus(200);

    }
    public function test_get_one_driver()
    {

        $response = $this->getJson('http://127.0.0.1:8000/api/drivers/2');
        $this->assertNotEmpty($response->json('data'));
        $response->assertStatus(200);

    }

    public function test_get_driver_should_fail()
    {

        $response = $this->getJson('http://127.0.0.1:8000/api/drivers/200');
        $response->assertStatus(400);
    }



    public function test_post_new_driver()
    {

        $data = [
            "id_number" => 9025199085,
            "phone_number" => 692118815,
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(204);

        $response = $this->getJson('http://127.0.0.1:8000/api/drivers/51');
        $response->assertStatus(200);
    }

    public function test_post_driver_with_invalid_phone_number() {

        // To little numbers
        $data = [
            "id_number" => 9025199085,
            "phone_number" => 69211881,
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(422);

        // To much numbers
        $data = [
            "id_number" => 9025199085,
            "phone_number" => 6921188155,
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(422);
    }


    public function test_post_driver_with_invalid_id_number() {

        // To little numbers
        $data = [
            "id_number" => 902519908,
            "phone_number" => 692118815,
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(422);

        // To much numbers
        $data = [
            "id_number" => 90251990855,
            "phone_number" => 692118815,
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(422);


    }


    public function test_post_driver_twice() {

        $data = [
            "id_number" => 9025199085,
            "phone_number" => 692118815,
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];


        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(204);


        // Then
        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(409);
    }

    

    public function test_that_id_and_phone_is_ints() {

        $data = [
            "id_number" => "90251l9085",
            "phone_number" => "692j18815",
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];


        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(422);


        // Then 
        $data = [
            "id_number" => "9025199085",
            "phone_number" => "692118815",
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(204);

    }


    public function test_edit_drivers_details() {
        
        $data = [
            "id_number" => "9025199085",
            "phone_number" => "692118815",
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];

        $new_data = [
            'driver_id' => 51,
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];
        

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(204);

        $response = $this->patchJson('http://127.0.0.1:8000/api/drivers/51/details', $new_data);
        $response->assertStatus(200);
    }


    public function test_delete_driver() {

        $data = [
            "id_number" => "9025199085",
            "phone_number" => "692118815",
            "first_name" => "Hogan",
            "last_name" => "Fortuin",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $data);
        $response->assertStatus(204);

        $response = $this->deleteJson('http://127.0.0.1:8000/api/drivers/51/');
        $response->assertStatus(200);
    }

    
}