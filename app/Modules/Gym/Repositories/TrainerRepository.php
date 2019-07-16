<?php

namespace App\Modules\Gym\Repositories;

use App\Modules\Gym\Entities\Trainer;
use App\Ship\Abstraction\AbstractRepository;
use App\Ship\Traits\DataForSelect;

class TrainerRepository extends AbstractRepository
{
    use DataForSelect;

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
        return Trainer::class;
    }
}
