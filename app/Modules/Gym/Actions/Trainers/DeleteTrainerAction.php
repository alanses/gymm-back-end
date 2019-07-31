<?php

namespace App\Modules\Gym\Actions\Trainers;

use App\Modules\Gym\Tasks\Trainers\DeleteTrainerTask;
use App\Ship\Abstraction\AbstractAction;

class DeleteTrainerAction extends AbstractAction
{
    public function run($id)
    {
        return $this->call(DeleteTrainerTask::class, [$id]);
    }
}
