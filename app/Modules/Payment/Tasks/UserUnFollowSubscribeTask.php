<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class UserUnFollowSubscribeTask extends AbstractTask
{
    public function run(User $user)
    {
        return $user->userDetail()->delete();
    }
}
