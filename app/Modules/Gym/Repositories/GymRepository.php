<?php

namespace App\Modules\Gym\Repositories;

use App\Modules\Gym\Entities\Gym;
use App\Ship\Abstraction\AbstractRepository;

class GymRepository extends AbstractRepository
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
        return Gym::class;
    }
}
