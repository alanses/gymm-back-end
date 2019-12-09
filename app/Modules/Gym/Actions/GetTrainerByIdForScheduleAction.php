<?php

namespace App\Modules\Gym\Actions;

use App\Modules\Gym\Tasks\Trainers\FindTrainerTask;
use App\Ship\Abstraction\AbstractAction;

class GetTrainerByIdForScheduleAction extends AbstractAction
{
    public function run($id)
    {
        $trainer = $this->call(FindTrainerTask::class, [], [
            ['getByField' => ['id', $id]],
            ['withCountClassSchedules' => []]
        ]);

        return $trainer->load('bookings.classSchedule.activityType');
    }
}
