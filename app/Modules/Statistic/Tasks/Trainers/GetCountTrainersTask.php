<?php

namespace App\Modules\Statistic\Tasks\Trainers;

use App\Modules\Gym\Entities\Gym;
use App\Ship\Abstraction\AbstractTask;

class GetCountTrainersTask extends AbstractTask
{
    public function run(Gym $gym)
    {
        return $gym->trainers()->count();
    }
}
