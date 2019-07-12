<?php

namespace App\Modules\User\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterUserTest extends TestCase
{
    use WithFaker;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->setUpFaker();

        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ])
            ->json('POST', 'api/registration/user', [
                'name' => $this->faker->name,
                'email' => $this->faker->email,
                'password' => 'secret'
            ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'user_id',
                    'email',
                    'name',
                    'response-content',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }
}
