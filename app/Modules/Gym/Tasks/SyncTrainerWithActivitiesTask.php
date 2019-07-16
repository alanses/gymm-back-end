<?php

namespace App\Modules\Gym\Tasks;

use App\Modules\Gym\Entities\Trainer;
use App\Ship\Abstraction\AbstractTask;

class SyncTrainerWithActivitiesTask extends AbstractTask
{
    public function run(Trainer $trainer, array $activities)
    {
        return $trainer->activities()->sync($activities);
    }
}
