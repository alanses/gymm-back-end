<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;

class DeleteClassScheduleTask extends AbstractTask
{

    /**
     * @var ClassScheduleRepository
     */
    private $repository;

    public function __construct(ClassScheduleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        return $this->repository->delete($id);
    }
}
