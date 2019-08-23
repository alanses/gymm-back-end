<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;

class GetLastClassScheduleTask extends AbstractTask
{
    /**
     * @var ClassScheduleRepository
     */
    private $classRepository;

    public function __construct(ClassScheduleRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }

    public function run()
    {
        return  $this->classRepository->getLastClassSchedule();
    }
}
