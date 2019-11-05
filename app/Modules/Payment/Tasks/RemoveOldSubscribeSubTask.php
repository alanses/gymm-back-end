<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Transactions\Entities\SubscribeHistory;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class RemoveOldSubscribeSubTask extends AbstractTask
{
    public function run(User $user)
    {
        if($this->checkIfUserHasSub($user)) {

            $subscribe = $this->call(GetUserSubscribeTask::class, [$user]);

            $this->call(UnFollowSubscribeTask::class, [$this->getSubscribeId($subscribe)]);

            $this->call(ChangeSubscribeStatusTask::class, [$subscribe]);

            $this->call(UserUnFollowSubscribeTask::class, [$user]);

            $this->call(DeleteSubscribedJobsTask::class, [$user]);
                // Work only if queue type is database
                // Temp solution
        }
    }

    private function checkIfUserHasSub(User $user)
    {
        return $user->userDetail ? true : false;
    }

    private function getSubscribeId(?SubscribeHistory $history)
    {
        return $history->subscribe_id;
    }
}
