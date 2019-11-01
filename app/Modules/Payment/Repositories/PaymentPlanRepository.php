<?php

namespace App\Modules\Payment\Repositories;

use App\Modules\Payment\Entities\PaymentPlan;
use App\Ship\Abstraction\AbstractRepository;

class PaymentPlanRepository extends AbstractRepository
{
    protected $fieldSearchable = [];

    /**
    * @throws \Prettus\Repository\Exceptions\RepositoryException
    */
    public function boot()
    {

    }

    /**
    * @return string
    */
    function model()
    {
        return PaymentPlan::class;
    }
}
