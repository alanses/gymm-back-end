<?php

namespace App\Modules\Achievements\Repositories;

use App\Modules\Achievements\Entities\Achievement;
use App\Ship\Abstraction\AbstractRepository;

class AchievementRepository extends AbstractRepository
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
        return Achievement::class;
    }
}
