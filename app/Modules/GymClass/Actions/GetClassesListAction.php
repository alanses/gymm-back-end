<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\Activities\Tasks\GetActivitiesByUserTask;
use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Support\Collection;
use App\Modules\User\Entities\User;
use App\Modules\UserProfile\Entities\UserSetting;

class GetClassesListAction extends AbstractAction
{
    public function run() :Collection
    {
        $classes = $this->call(GetClassScheduleTask::class, []);

        return $classes->load([
            'trainer.avgRating', 'gym', 'activityType'
        ]);
    }

    private function getActivitiesIds(User $user) :array
    {
        $activities = $this->call(GetActivitiesByUserTask::class, [$user]);

        return $activities->map(function ($activity) {
            return $activity->id;
        })->toArray();
    }

    private function getUserSetting(User $user)
    {
        return $user->userSetting;
    }

    private function getUserLevel(UserSetting $userSetting) :?int
    {
        return $userSetting ? $userSetting->level : null;
    }

    private function getCretitsFrom(UserSetting $userSetting)
    {
        return $userSetting ? $userSetting->cretits_from : null;
    }

    private function getCretitsTo(UserSetting $userSetting)
    {
        return $userSetting ? $userSetting->cretits_to : null;
    }

    private function getSpots(UserSetting $userSetting)
    {
        return $userSetting->spots;
    }
}
