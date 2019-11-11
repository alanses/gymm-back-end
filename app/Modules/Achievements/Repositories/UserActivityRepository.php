<?php

namespace App\Modules\Achievements\Repositories;

use App\Modules\Achievements\Entities\UserActivity;
use App\Ship\Abstraction\AbstractRepository;

class UserActivityRepository extends AbstractRepository
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
        return UserActivity::class;
    }
}
