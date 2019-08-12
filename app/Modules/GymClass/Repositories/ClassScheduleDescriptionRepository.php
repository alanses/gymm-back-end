<?php

namespace App\Modules\GymClass\Repositories;

use App\Modules\GymClass\Entities\ClassScheduleDescription;
use App\Ship\Abstraction\AbstractRepository;

class ClassScheduleDescriptionRepository extends AbstractRepository
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
        return ClassScheduleDescription::class;
    }
}
