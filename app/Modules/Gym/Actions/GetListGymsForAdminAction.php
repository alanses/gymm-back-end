<?php

namespace App\Modules\Gym\Actions;

use App\Modules\Gym\Tasks\GetGymTask;
use App\Ship\Abstraction\AbstractAction;

class GetListGymsForAdminAction extends AbstractAction
{
    public function run()
    {
        $gyms = $this->call(GetGymTask::class);

        return $gyms->load(['user']);
    }
}
