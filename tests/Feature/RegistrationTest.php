<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        Storage::fake('avatars');

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', 'api/registration', [
            'first_name' => 'Ali',
            'last_name' => 'Gamal',
            'phone_number' => '+201001237771',
            'country_code' => 'EG',
            'birthdate' => '1988-03-29',
            'gender' => 'male',
            'avatar' => UploadedFile::fake()->image('photo1.jpeg'),
            'email' => 'omar1234@faydety.com',
            'password' => '123456'
        ]);

        $response->assertStatus(201);
        $response->assertJson([
        "id"=> 35,
        "first_name"=>"Ali",
        "last_name"=> "Gamal",
        "country_code"=> "EG",
        "phone_number"=> "+201001237771",
        "gender"=> "male",
        "birthdate"=> "1988-03-29"
        ]);
    }

}
