<?php

namespace App\Modules\Gym\Tests;

use App\Modules\Gym\Entities\Trainer;
use App\Ship\Abstraction\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;

class TrainerTest extends AbstractTestCase
{
    use WithFaker;



    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateTrainer()
    {
        $this->setUpFaker();

        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $this->getToken()
            ])
            ->json('POST', 'api/create/trainer', [
                'user_id' => 3,
                'trainer_name' => $this->faker->name,
                'level' => 1,
                'cretits_from' => rand(1, 10),
                'cretits_to' => rand(11, 20),
                'activities' => [1,2,3]
            ]);

        $response->assertStatus(201);
    }

    public function testDeleteTrainer()
    {
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $this->getToken()
            ])
            ->delete('api/trainer/' . Trainer::getLastRecord());

        $response->assertStatus(200);
    }
}
