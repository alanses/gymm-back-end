<?php

namespace App\Modules\Booking\Actions;

use App\Modules\GymClass\Repositories\ClassScheduleRepository;
use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Ship\Abstraction\AbstractAction;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetBookingPreviewAction extends AbstractAction
{
    public function run($id)
    {
        $classSchedule = $this->call(GetClassScheduleTask::class, [], [
            ['findByField' => ['id', $id]]
        ]);

        return $classSchedule->first();
    }
}
