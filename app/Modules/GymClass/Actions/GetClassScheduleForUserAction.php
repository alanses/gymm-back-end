<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Ship\Abstraction\AbstractAction;

class GetClassScheduleForUserAction extends AbstractAction
{
    public function run($id)
    {
        $scheduleClass = $this->call(GetClassScheduleTask::class, [], [
            [
                'findByField' => ['id', $id]
            ]
        ])
            ->first()
            ->load([
                'gym',
                'activityType',
                'classScheduleDescription.user.userSetting',
            ]);

        return $scheduleClass;
    }
}
