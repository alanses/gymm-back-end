<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Ship\Abstraction\AbstractAction;

class GetClassScheduleAction extends AbstractAction
{
    public function run($id)
    {
        return $this->call(GetClassScheduleTask::class, [], [
            [
                'getByField' => ['id', $id]
            ]
        ])
            ->first();
    }
}
