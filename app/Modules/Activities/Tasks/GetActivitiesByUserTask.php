<?php

namespace App\Modules\Activities\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class GetActivitiesByUserTask extends AbstractTask
{
    public function run(User $user)
    {
        return $user->activities;
    }
}
