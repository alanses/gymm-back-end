<?php

namespace App\Modules\Location\Tests;

use App\Ship\Abstraction\AbstractTestCase;

class GetListCitiesTest extends AbstractTestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetListCities()
    {
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $this->getToken()
            ])
            ->get('api/list/cities/for/select');

        $response
            ->assertStatus(200);
    }
}
