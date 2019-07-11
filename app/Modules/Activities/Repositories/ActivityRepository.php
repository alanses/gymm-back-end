<?php

namespace App\Modules\Activities\Repositories;

use App\Modules\Activities\Entities\Activity;
use App\Ship\Abstraction\AbstractRepository;

class ActivityRepository extends AbstractRepository
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
        return Activity::class;
    }
}
