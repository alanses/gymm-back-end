<?php

namespace App\Modules\Achievements\Tasks;

use App\Modules\Achievements\Repositories\UserActivityRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class FindUserAchievementTask extends AbstractTask
{
    private $repository;

    private function __construct(UserActivityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
    }

    private function whereUserIs(int $userId)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('user_id', $userId));
    }

    private function whereActivityIs(int $activity_id)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('activity_id', $activity_id));
    }
}
