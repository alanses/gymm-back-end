<?php

namespace App\Modules\Statistic\Actions\Gym;

use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\Statistic\Tasks\Trainers\GetCountTrainersTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class GetCountTrainersAction extends AbstractAction
{
    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        $count_trainers = $this->call(GetCountTrainersTask::class, [$gym]);

        return $count_trainers;
    }
}
