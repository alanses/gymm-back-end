<?php

namespace App\Modules\Gym\Tasks;

use App\Modules\Gym\Repositories\GymRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetGymTask extends AbstractTask
{
    /**
     * @var GymRepository
     */
    private $repository;

    public function __construct(GymRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->get();
    }

    public function findByField($field, $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }
}
