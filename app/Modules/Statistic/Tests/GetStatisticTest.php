<?php

namespace App\Modules\Statistic\Tests;

use App\Ship\Abstraction\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetStatisticTest extends AbstractTestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetStatistic()
    {
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $this->getToken()
            ])
            ->get('api/gym/profile/statistic');

        $response
            ->assertStatus(403);
    }
}
