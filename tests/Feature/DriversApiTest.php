<?php

namespace Tests\Feature;

use App\Models\Detail;
use App\Models\Driver;
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


        // $driver = Detail::factory()->create([
        //     'first_name' => 'John',
        // ])->save();
        $data = [
            
            "id_number" => 9485969685,
            "phone_number" => 538464839,
            "first_name" => "John",
            "last_name" => "Baptiste",
            "home_address" => "84, 9th Ave Leonsdale",
            "license_type" => "A"
            
        ];

        $user = Driver::create($data);

        $detail = new Detail($data);
        $detail->driver_id = $user->id;
        $detail->save();

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

    protected $general_structure = [
        'status',
        'success',
        'message',
        'data' => [
            '*' => [
                'id',
                'id_number',
                'phone_number',
                'details' => [
                    'first_name', 
                    'last_name',
                    'home_address',
                    'license_type',
                    'driver_id',
                    'last_trip'
                ]
                
            ]
        ]
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
        $response->assertJsonStructure($this->general_structure);
    }



    public function test_get_drivers_by_name() {
        $response = $this->getJson('http://127.0.0.1:8000/api/drivers?name=John');
        $response->assertStatus(200);

        $response->assertJson(
            [
                'status' => 'OK',
                'success' => true,
                'message' => "",
                
            ]
        );

        $this->assertDatabaseHas('details', [
            'first_name' => 'John',
            // 'last_name' => 'Baptiste'
        ]);

        // $response->assertJsonStructure($this->general_structure);
    }


    public function test_get_one_driver()
    {

        $response = $this->getJson('http://127.0.0.1:8000/api/drivers/2');
        $this->assertNotEmpty($response->json('data'));
        $response->assertStatus(200);
        // $response->assertJsonStructure($this->general_structure);

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

        $this->assertDatabaseHas('details', [
            'first_name' => 'Hogan',
            'last_name' => 'Fortuin'
        ]);

    }
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

        $this->assertDatabaseMissing('details', [
            'first_name' => 'Hogan',
            'last_name' => 'Fortuin'
        ]);
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

        $this->assertDatabaseMissing('details', [
            'first_name' => 'Hogan',
            'last_name' => 'Fortuin'
        ]);
    }


    public function test_post_driver_twice() {


        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(204);

        // Then should fail cause Driver exists
        $response = $this->postJson('http://127.0.0.1:8000/api/drivers/', $this->data);
        $response->assertStatus(409);

        $response->assertJson(
            [
                'status' => 'ERROR',
                'success' => false,
                'message' => "Driver already exist with this ID Number!!!.",
                
            ]
        );

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