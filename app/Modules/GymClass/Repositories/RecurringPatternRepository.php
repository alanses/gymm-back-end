<?php

namespace App\Modules\GymClass\Repositories;

use App\Modules\GymClass\Entities\RecurringPattern;
use App\Ship\Abstraction\AbstractRepository;

class RecurringPatternRepository extends AbstractRepository
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
        return RecurringPattern::class;
    }
}
