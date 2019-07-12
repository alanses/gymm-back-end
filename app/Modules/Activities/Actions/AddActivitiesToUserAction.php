<?php

namespace App\Modules\Activities\Actions;

use App\Modules\Activities\Tasks\SyncUserWithActivitiesTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;

class AddActivitiesToUserAction extends AbstractAction
{
    public function run(User $user, array $list_activities)
    {
        return $this->call(SyncUserWithActivitiesTask::class, [$user, $list_activities]);
    }
}
