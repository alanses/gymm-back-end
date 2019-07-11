<?php

namespace App\Modules\Activities\Actions;

use App\Modules\Activities\Tasks\GetActivitiesTask;
use App\Ship\Abstraction\AbstractAction;

class GetAllActivitiesAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetActivitiesTask::class);
    }
}
