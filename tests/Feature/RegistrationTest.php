<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
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
        ])->json('POST', 'api/analyse', [
            'first_name' => 'Ali',
            'last_name' => 'Gamal',
            'phone_number' => '01001234567',
            'country_code' => 'EG',
            'birthdate' => '1988-03-29',
            'gender' => 'male',
            'avatar' => UploadedFile::fake()->image('photo1.jpeg'),
            'email' => 'omar@faydety.com',
            'password' => '123456'
        ]);

        $response->assertStatus(200);
    }
//    function upload_file_test()
//    {
//        Storage::fake('public');
//
//        $this->json('post', '/upload', [
//            'file' => $file = UploadedFile::fake()->image('random.jpg')
//        ]);
//
//        $this->assertEquals('file/' . $file->hashName(), Upload::latest()->first()->file);
//
//        Storage::disk('public')->assertExists('file/' . $file->hashName());
//    }
}
