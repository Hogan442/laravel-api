<?php

namespace Tests\Feature;

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
    public function test_get_all_drivers()
    {

        $response = $this->getJson('http://127.0.0.1:8000/api/drivers');
        $response->assertStatus(200);

        $response->assertJson(
            [
                'status' => 'OK',
                'success' => true,
                'message' => "",
                
            ]
        );

    }
    public function test_get_one_driver()
    {

        $response = $this->getJson('http://127.0.0.1:8000/api/drivers/2');
        $this->assertNotEmpty($response->json('data'));
        $response->assertStatus(200);

        $response->assertJson(
            [
                'status' => 'OK',
                'success' => true,
                'message' => "",
                
            ]
        );

    }

    public function test_get_driver_should_fail()
    {

        $response = $this->getJson('http://127.0.0.1:8000/api/drivers/200');
        $response->assertStatus(400);

        $response->assertJson(
            [
                'status' => 'ERROR',
                'success' => false,
                'message' => "Could not get your driver",
                
            ]
        );

        
    }



    public function test_post_new_driver()
    {

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(204);

        $response = $this->getJson('http://127.0.0.1:8000/api/drivers/51');
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

        // $content = $response->decodeResponseJson();
        // $data = array_values($content['data'])[3];
        // $this->assertTrue($data['first_name'] == 'Hogan');
    }
        // print_r(array_values(array_values($content['data'])[3])[0]);

    public function test_post_driver_with_invalid_phone_number() {

        // Too little numbers
        $this->data['phone_number'] = 69211881;

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(422);

        $response->assertJson(
            [
                "message" => "The given data was invalid.",

                "errors" => [
            
                    "phone_number" => [
            
                        "The phone number must be at least 111111111."
            
                    ]
                ]
            ]
        );

        // Too much numbers
        $this->data['phone_number'] = 6921188155;

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(422);

        $response->assertJson(
            [
                "message" => "The given data was invalid.",

                "errors" => [
            
                    "phone_number" => [
            
                        "The phone number must not be greater than 999999999."
            
                    ]
                ]
            ]
        );
    }


    public function test_post_driver_with_invalid_id_number() {

        // To little numbers
        $this->data['id_number'] = 902519908;

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(422);

        $response->assertJson(
            [
                "message" => "The given data was invalid.",

                "errors" => [
            
                    "id_number" => [
            
                        "The id number must be at least 1111111111."
            
                    ]
                ]
            ]
        );

        // To much numbers
        $this->data['id_number'] = 90251990855;

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(422);

        $response->assertJson(
            [
                "message" => "The given data was invalid.",

                "errors" => [
            
                    "id_number" => [
            
                        'The id number must not be greater than 9999999999.'
            
                    ]
                ]
            ]
        );


    }


    public function test_post_driver_twice() {


        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(204);

        $response->assertJson(
            [
                'status' => '',
                'success' => true,
                'message' => "",
                
            ]
        );

        // Then should fail cause Driver exists
        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(409);
    }

    

    public function test_that_id_and_phone_is_ints() {

        $invalid_data = $this->data;
        $invalid_data['id_number'] = '90251l9085';
        $invalid_data['phone_number'] = "90251l9085";


        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $invalid_data);
        $response->assertStatus(422);


        // Then should pass cause input was valid
        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(204);

    }


    public function test_edit_drivers_details() {

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(204);

        // update the newly created drivers name
        $new_data = [
            'driver_id' => 51,
            "first_name" => "Luke",
        ];
        
        $response = $this->patchJson('http://127.0.0.1:8000/api/drivers/51/details', $new_data);
        $response->assertStatus(200);
    }


    public function test_delete_driver() {

        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(204);

        $response = $this->deleteJson('http://127.0.0.1:8000/api/drivers/51/');
        $response->assertStatus(200);


        // Driver should not exist after failure
        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/51', $this->data);
        $response->assertStatus(405);
    }

    
}