<?php

namespace App\Modules\Authentication\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginUserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])
            ->json('POST', 'api/login', [
                'email' => 'TestUser@gmail.com',
                'password' => '12345678',
            ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'email',
                    'name',
                    'response-content' => [
                        'token_type',
                        'expires_in',
                        'access_token',
                        'refresh_token'
                    ],
                    'created_at',
                    'updated_at'
                ]
            ]);

    }
}
