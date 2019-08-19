<?php

namespace App\Modules\UserProfile\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class GetUserDetailTask extends AbstractTask
{
    public function run(User $user)
    {
        return $user->userDetail;
    }
}
