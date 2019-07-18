<?php

namespace App\Modules\Plans\Repositories;

use App\Modules\Plans\Entities\Plan;
use App\Ship\Abstraction\AbstractRepository;

class PlanRepository extends AbstractRepository
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
        return Plan::class;
    }
}
