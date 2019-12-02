<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\GymClass\Tasks\GetListEventsTask;
use App\Ship\Abstraction\AbstractAction;

class GetClassScheduleFullInfoAction extends AbstractAction
{
    public function run($id)
    {
        $classSchedule = $this->call(GetListEventsTask::class, [], [
            ['findByField' => ['id', $id]]
        ]);

        if($classSchedule = $classSchedule->first()) {
            return $classSchedule->load(['trainer', 'gym', 'activityType']);
        }
    }
}
