<?php

namespace App\Modules\GymClass\Actions;


use App\Modules\GymClass\Http\Requests\ClassScheduleRequest;
use App\Modules\GymClass\Tasks\CreateClassScheduleTask;
use App\Modules\GymClass\Tasks\CreateRecurringPatternTask;
use App\Ship\Abstraction\AbstractSubAction;

class CreateClassScheduleSubAction extends AbstractSubAction
{
    public function run(ClassScheduleRequest $request)
    {
        $this->call(CreateClassScheduleTask::class, [
            $this->getDataForCreateEvent($request)
        ]);

        $this->call(CreateRecurringPatternTask::class);
    }

    public function getDataForCreateEvent(ClassScheduleRequest $request)
    {
        return $request->only([
            'activities_id',
            'class_type_id',
            'level',
            'credits',
            'start_date',
            'start_time',
            'end_time',
            'trainer_id',
            'photo',
            'repeat'
        ]);
    }
}
