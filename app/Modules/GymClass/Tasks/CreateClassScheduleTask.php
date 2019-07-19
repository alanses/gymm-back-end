<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Repositories\GymClassRepository;
use App\Ship\Abstraction\AbstractTask;

class CreateClassScheduleTask extends AbstractTask
{
    /**
     * @var GymClassRepository
     */
    private $classRepository;

    public function __construct(GymClassRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }

    public function run()
    {

    }
}
