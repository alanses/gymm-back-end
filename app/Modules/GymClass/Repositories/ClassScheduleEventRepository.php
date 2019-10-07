<?php

namespace App\Modules\GymClass\Repositories;

use App\Modules\GymClass\Entities\ClassScheduleEvent;
use App\Ship\Abstraction\AbstractRepository;

class ClassScheduleEventRepository extends AbstractRepository
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
        return ClassScheduleEvent::class;
    }
}
