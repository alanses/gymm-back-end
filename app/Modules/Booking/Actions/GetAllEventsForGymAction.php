<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Tasks\GetListClassSchedulesEventsTask;
use App\Modules\Booking\Tasks\GetListClassSchedulesTask;
use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class GetAllEventsForGymAction extends AbstractAction
{
    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);
        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        return $this->call(GetListClassSchedulesEventsTask::class, [], [
            ['whereGymIs' => [$gym->id]],
        ])->load(['trainer', 'classType', 'activityType']);
    }
}
