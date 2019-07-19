<?php

namespace App\Modules\GymClass\Repositories;

use App\Modules\GymClass\Entities\RecurringType;
use App\Ship\Abstraction\AbstractRepository;

class RecurringTypeRepository extends AbstractRepository
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
        return RecurringType::class;
    }
}
