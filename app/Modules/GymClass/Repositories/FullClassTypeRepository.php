<?php

namespace App\Modules\GymClass\Repositories;

use App\Modules\GymClass\Entities\FullClassType;
use App\Ship\Abstraction\AbstractRepository;

class FullClassTypeRepository extends AbstractRepository
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
        return FullClassType::class;
    }
}
