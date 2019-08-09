<?php

namespace App\Modules\Gym\Actions;

use App\Modules\Gym\Tasks\GetListGymsTask;
use App\Ship\Abstraction\AbstractAction;

class GetListGymsAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListGymsTask::class);
    }
}
