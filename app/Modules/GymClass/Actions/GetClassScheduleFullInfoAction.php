<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Ship\Abstraction\AbstractAction;

class GetClassScheduleFullInfoAction extends AbstractAction
{
    public function run($id)
    {
        $classSchedule = $this->call(GetClassScheduleTask::class, [], [
            ['findByField' => ['id', $id]]
        ]);

        if($classSchedule = $classSchedule->first()) {
            return $classSchedule->load(['trainer', 'gym']);
        }
    }
}
