<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Ship\Abstraction\AbstractAction;

class GetClassAttachedToGymAction extends AbstractAction
{
    public function run($gym_id)
    {
        return $this->call(GetClassScheduleTask::class, [], [
            ['getByField' => ['gym_id', $gym_id]]
        ]);
    }
}
