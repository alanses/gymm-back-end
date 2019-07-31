<?php

namespace App\Modules\Gym\Repositories;

use App\Modules\Gym\Entities\RatingForTrainer;
use App\Ship\Abstraction\AbstractRepository;

class RatingForTrainerRepository extends AbstractRepository
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
        return RatingForTrainer::class;
    }
}
