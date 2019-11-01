<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class GetUserSubscribeTask extends AbstractTask
{
    public function run(User $user)
    {
        return $user->userSubscribeHistory()
            ->latest()
            ->first();
    }
}
