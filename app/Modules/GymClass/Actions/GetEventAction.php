<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\GymClass\Tasks\GetEventTask;
use App\Ship\Abstraction\AbstractAction;

class GetEventAction extends AbstractAction
{
    public function run($id)
    {
        $event = $this->call(GetEventTask::class, [], [
            ['whereIdIs' => [$id]]
        ]);

        return $event->load(['reviews.user', 'trainer', 'activityType']);
    }
}
