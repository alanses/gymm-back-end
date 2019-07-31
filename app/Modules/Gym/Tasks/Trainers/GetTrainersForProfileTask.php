<?php

namespace App\Modules\Gym\Tasks\Trainers;

use App\Modules\Gym\Entities\Gym;
use App\Ship\Abstraction\AbstractTask;

class GetTrainersForProfileTask extends AbstractTask
{
    public function run(Gym $gym)
    {
        return $gym
            ->trainers()
            ->get($this->getSelectedFields())
            ->load(['avgRating']);
    }
}
