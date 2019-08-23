<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Http\Requests\ClassScheduleRequest;
use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Ship\Abstraction\AbstractTask;

class CreateClassScheduleTask extends AbstractTask
{
    /**
     * @var ClassScheduleRepository
     */
    private $classRepository;

    public function __construct(ClassScheduleRepository $classRepository)
    {
        $this->classRepository = $classRepository;
    }

    public function run(array $data)
    {
        $this->classRepository->insert($data);
    }

    /**
     * @param ClassScheduleRequest $request
     * @return string
     */
    public function getIsRecurring(ClassScheduleRequest $request) :string
    {
        return $request->repeat ? 'Y' : 'N';
    }
}
