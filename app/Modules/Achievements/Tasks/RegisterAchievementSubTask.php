<?php

namespace App\Modules\Achievements\Tasks;

use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class RegisterAchievementSubTask extends AbstractTask
{
    public function run(ClassSchedule $classSchedule, User $user)
    {
        if($activityType = $classSchedule->activityType) {

            $userActivities = $this->call(FindUserAchievementTask::class, []);

            dd($activityType, $userActivities);
        }
    }
}
