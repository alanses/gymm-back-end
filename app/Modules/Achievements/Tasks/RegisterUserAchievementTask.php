<?php

namespace App\Modules\Achievements\Tasks;

use App\Modules\Achievements\Repositories\UserActivityRepository;
use App\Modules\Activities\Entities\Activity;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class RegisterUserAchievementTask extends AbstractTask
{
    /**
     * @var UserActivityRepository
     */
    private $repository;

    public function __construct(UserActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(Activity $activity, User $user, $userActivities)
    {
        return is_null($userActivities) ? $this->createAchievement($activity, $user) : $this->updateAchievement($userActivities);
    }

    private function createAchievement(Activity $activity, User $user)
    {
        return $this->repository->create([
            'user_id' => $user->id,
            'activity_id' => $activity->id,
            'count_visiting' => 0
        ]);
    }

    private function updateAchievement($userActivities)
    {
        return $userActivities->update([
            'count_visiting' => $userActivities->count_visiting + 1
        ]);
    }
}
