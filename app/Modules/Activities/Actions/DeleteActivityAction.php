<?php

namespace App\Modules\Activities\Actions;

use App\Modules\Activities\Tasks\DeleteActivityFileTask;
use App\Modules\Activities\Tasks\DeleteActivityTask;
use App\Modules\Activities\Tasks\GetActivityTask;
use App\Ship\Abstraction\AbstractAction;

class DeleteActivityAction extends AbstractAction
{
    public function run($id)
    {
        $activity = $this->call(GetActivityTask::class, [], [
            ['findByField' => ['id', $id]]
        ]);

        $this->call(DeleteActivityFileTask::class, [$activity]);
        $this->call(DeleteActivityTask::class, [$activity]);
    }
}
