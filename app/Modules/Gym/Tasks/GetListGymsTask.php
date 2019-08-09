<?php

namespace App\Modules\Gym\Tasks;

use App\Modules\Gym\Repositories\GymRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetListGymsTask extends AbstractTask
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
        return $this->repository
            ->get();
    }

    /**
     * @param $field
     * @param $value
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function findByField($field, $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }
}
