<?php

namespace App\Modules\GymClass\Repositories;

use App\Modules\GymClass\Entities\ClassType;
use App\Ship\Abstraction\AbstractRepository;

class ClassTypeRepository extends AbstractRepository
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
        return ClassType::class;
    }
}
