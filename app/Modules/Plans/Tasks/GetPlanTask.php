<?php

namespace App\Modules\Plans\Tasks;

use App\Modules\Plans\Repositories\PlanRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetPlanTask extends AbstractTask
{
    /**
     * @var PlanRepository
     */
    private $repository;

    public function __construct(PlanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->first();
    }

    public function findByField($field, $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }
}
