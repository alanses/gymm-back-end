<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetClassScheduleTask extends AbstractTask
{
    /**
     * @var ClassScheduleRepository
     */
    private $repository;

    public function __construct(ClassScheduleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->get();
    }

    public function getByField(string $fieldName, string $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($fieldName, $value));
    }
}
