<?php

namespace App\Modules\GymClass\Http\Controllers;

use App\Modules\GymClass\Actions\CreateClassScheduleAction;
use App\Modules\GymClass\Http\Requests\ClassScheduleRequest;
use App\Ship\Parents\ApiController;

class GymClassController extends ApiController
{
    public function createClassSchedule(ClassScheduleRequest $request)
    {
        $this->call(CreateClassScheduleAction::class, [$request]);

        return $this->success('ok');
    }
}
