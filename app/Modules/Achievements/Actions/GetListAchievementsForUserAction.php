<?php

namespace App\Modules\Achievements\Actions;

use App\Modules\Achievements\Tasks\GetAchivementsForUserTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class GetListAchievementsForUserAction extends AbstractAction
{
    public function run()
    {
        $collection = collect();

        $user = $this->call(GetAuthenticatedUserTask::class);

        $userBookings = $user->load(['userPassedBookings.classSchedule.activityType', 'language']);

        $achievements = $this->call(GetAchivementsForUserTask::class);

        $collection->put('user', $userBookings);
        $collection->put('achievements', $achievements);

        return $collection;
    }
}
