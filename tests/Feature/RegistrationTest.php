<?php

namespace Tests\Feature;

use http\Env\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;


class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        Storage::fake('avatars');

        $response = $this-> withHeaders([
            'Accept' => 'application/json',
        ])->json('POST', 'api/registration', [
            'first_name' => 'Ali',
            'last_name' => 'Gamal',
            'phone_number' => '+201001237779',
            'country_code' => 'EG',
            'birthdate' => '1988-03-29',
            'gender' => 'male',
            'avatar' => UploadedFile::fake()->image('avatar.jpeg'),
            'email' => 'omar127@faydety.com',
            'password' => '123456'
        ]);
//        info($response);
        $response->assertStatus(201);
        $response->assertJson([
            'first_name' => 'Ali',
            'last_name' => 'Gamal',
            'phone_number' => '+201001237779',
            'country_code' => 'EG',
            'birthdate' => '1988-03-29',
            'gender' => 'male',
            'id' => 1,
    ]);
    }

}
