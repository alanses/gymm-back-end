<?php

namespace App\Modules\UserProfile\Actions;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractAction;

class UpdateUserActivitiesAction extends AbstractAction
{
    public function run(array $list_activities, User $user)
    {
        $user->activities()->sync($list_activities);

        return $user;
    }
}
