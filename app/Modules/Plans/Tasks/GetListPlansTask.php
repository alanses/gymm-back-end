<?php

namespace App\Modules\Plans\Tasks;

use App\Modules\Plans\Repositories\PlanRepository;
use App\Ship\Abstraction\AbstractTask;

class GetListPlansTask extends AbstractTask
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
        return $this->repository->all();
    }
}
