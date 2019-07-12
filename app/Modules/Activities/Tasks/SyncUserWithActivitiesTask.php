<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class SyncUserWithActivitiesTask extends AbstractTask
{
    public function run(User $user, array $list_activities)
    {
        $user->activities()->sync($list_activities);

        return $user;
    }
}
