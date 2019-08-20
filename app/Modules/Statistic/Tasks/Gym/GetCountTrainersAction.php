<?php

namespace App\Modules\Statistic\Tasks\Gym;

use App\Modules\Gym\Entities\Gym;
use App\Modules\Statistic\Tasks\Trainers\GetCountTrainersTask;
use App\Ship\Abstraction\AbstractAction;

class GetCountTrainersAction extends AbstractAction
{
    public function run(Gym $gym)
    {
        $count_trainers = $this->call(GetCountTrainersTask::class, [$gym]);

        return $count_trainers;
    }
}
