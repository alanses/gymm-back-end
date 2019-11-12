<?php

namespace App\Modules\Achievements\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class GetUserAchivementTask extends AbstractTask
{
    public function run(User $user)
    {
        return $user->load(['userActivity.activity']);
    }
}
