<?php

namespace App\Modules\Payment\Actions;

use App\Modules\Payment\Tasks\GetUserSubscribeTask;
use App\Modules\Payment\Tasks\UnFollowSubscribeTask;
use App\Modules\Transactions\Entities\SubscribeHistory;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class UnFollowSubscribeAction extends AbstractAction
{
    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $subscribe = $this->call(GetUserSubscribeTask::class, [$user]);

        $this->call(UnFollowSubscribeTask::class, [$this->getSubscribeId($subscribe)]);
    }

    private function getSubscribeId(?SubscribeHistory $history) {
        return $history->subscribe_id;
    }
}
