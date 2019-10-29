<?php

namespace App\Modules\Payment\Repositories;

use App\Modules\Payment\Entities\UserSubscribePlan;
use App\Ship\Abstraction\AbstractRepository;

class UserSubscribePlanRepository extends AbstractRepository
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
        return UserSubscribePlan::class;
    }
}
