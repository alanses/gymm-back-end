<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Repositories\ClassScheduleDescriptionRepository;
use App\Ship\Abstraction\AbstractTask;

class SaveClassScheduleDescriptionTask extends AbstractTask
{
    /**
     * @var ClassScheduleDescriptionRepository
     */
    private $repository;

    public function __construct(ClassScheduleDescriptionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $attributes)
    {
        return $this->repository->create($attributes);
    }
}
