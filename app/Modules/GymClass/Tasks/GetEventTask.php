<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Repositories\ClassScheduleEventRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetEventTask extends AbstractTask
{

    /**
     * @var ClassScheduleEventRepository
     */
    private $repository;

    public function __construct(ClassScheduleEventRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->first();
    }

    public function whereIdIs($value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('id', $value));
    }
}
