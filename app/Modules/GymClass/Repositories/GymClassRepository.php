<?php

namespace App\Modules\GymClass\Repositories;

use App\Modules\GymClass\Entities\GymClass;
use App\Ship\Abstraction\AbstractRepository;

class GymClassRepository extends AbstractRepository
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
        return GymClass::class;
    }
}
