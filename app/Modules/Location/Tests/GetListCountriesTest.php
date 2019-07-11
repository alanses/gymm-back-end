<?php

namespace App\Modules\Location\Tests;

use App\Ship\Abstraction\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetListCountriesTest extends AbstractTestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetListCountries()
    {
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $this->getToken()
            ])
            ->get('api/list/countries/for/select');

        $response
            ->assertStatus(200);
    }
}
