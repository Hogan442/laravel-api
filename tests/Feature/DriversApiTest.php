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
    public function test_getDrivers()
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


        $response = $this->getJson('http://127.0.0.1:8000/api/drivers/');
        $response->dump();
    }
}