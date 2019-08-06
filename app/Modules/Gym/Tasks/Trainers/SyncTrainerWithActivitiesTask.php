<?php

namespace App\Modules\Gym\Tasks\Trainers;

use App\Modules\Gym\Entities\Trainer;
use App\Ship\Abstraction\AbstractTask;

class SyncTrainerWithActivitiesTask extends AbstractTask
{
    public function run(Trainer $trainer, ?string $activities)
    {
        $activities = $this->parseActivities($activities);

        return $trainer->activities()->sync($activities);
    }

    private function parseActivities($activities)
    {
        if(!$activities) {
            return [];
        }

        return explode(',', $activities);
    }
}
