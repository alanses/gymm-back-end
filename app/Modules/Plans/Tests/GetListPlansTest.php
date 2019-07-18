<?php

namespace App\Modules\Plans\Tests;

use App\Ship\Abstraction\AbstractTestCase;

class GetListPlansTest extends AbstractTestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetListPlans()
    {
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => $this->getToken()
            ])
            ->get('api/list/plans');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'plan_id',
                    'name',
                    'description',
                    'count_credits',
                    'payment_for_month',
                    'count_class'
                ]
            ]);
    }
}
