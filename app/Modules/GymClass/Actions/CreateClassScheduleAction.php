<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\GymClass\Http\Requests\ClassScheduleRequest;
use App\Modules\GymClass\Http\Service\ClassDateSchedule;
use App\Ship\Abstraction\AbstractAction;

class CreateClassScheduleAction extends AbstractAction
{
    public function run(ClassScheduleRequest $request)
    {
       return $this->call(CreateClassScheduleSubAction::class, [$request]);
    }
}
