<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DriversApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_getDrivers()
    {

        
        $response = $this->getJson('http://127.0.0.1:8000/api/drivers');
        dd($response->json());
        $this->assertNotEmpty($response->json('data'));
        $response->assertStatus(200);

    }


}
