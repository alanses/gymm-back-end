<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\Activities\Repositories\ActivityRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetActivityTask extends AbstractTask
{
    /**
     * @var ActivityRepository
     */
    private $repository;

    public function __construct(ActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->first();
    }

    public function findByField(string $field, string $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }
}
