<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\GymClass\Entities\ClassSchedule;
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

    public function run(ClassScheduleRequest $request) : ClassSchedule
    {
        return $this->classRepository->create([
            'class_type_id' => $request->class_type_id,
            'activities_id' => $request->activities_id,
            'level' => $request->level,
            'credits' => $request->credits,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => null,
            'trainer_id' => $request->trainer_id,
            'end_time' => $request->end_time,
            'is_recurring' => $this->getIsRecurring($request),
            'max_count_persons' => $request->count_persons
        ]);
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
