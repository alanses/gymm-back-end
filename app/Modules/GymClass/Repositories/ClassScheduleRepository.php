<?php

namespace App\Modules\GymClass\Repositories;

use App\Modules\GymClass\Entities\ClassSchedule;
use App\Ship\Abstraction\AbstractRepository;

class ClassScheduleRepository extends AbstractRepository
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
        return ClassSchedule::class;
    }
}
