<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\GymClass\Tasks\DeleteClassScheduleTask;
use App\Ship\Abstraction\AbstractAction;

class DeleteClassScheduleAction extends AbstractAction
{
    public function run($id)
    {
        return $this->call(DeleteClassScheduleTask::class, [$id]);
    }
}
