<?php

namespace App\Modules\GymClass\Http\Controllers;

use App\Modules\GymClass\Actions\CreateClassScheduleAction;
use App\Modules\GymClass\Http\Requests\ClassScheduleRequest;
use App\Modules\GymClass\Transformers\ClassSchedulesCollection;
use App\Ship\Parents\ApiController;

class GymClassController extends ApiController
{
    public function createClassSchedule(ClassScheduleRequest $request)
    {
        $classSchedule = $this->call(CreateClassScheduleAction::class, [$request]);

        return new ClassSchedulesCollection($classSchedule);
    }
}
