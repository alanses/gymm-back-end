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
            ->withCount('classSchedules')
            ->get($this->getSelectedFields())
            ->load([
                'avgRating',
                'photo',
                'bookings'
            ]);
    }
}
