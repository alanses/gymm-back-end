<?php

namespace App\Modules\Statistic\Actions\Gym;

use App\Modules\Gym\Entities\Gym;
use App\Ship\Abstraction\AbstractAction;

class GetCountClientsAction extends AbstractAction
{
    public function run(Gym $gym)
    {
        $sum = $gym->classSchedules()->sum('count_persons');

        return (int)$sum;
    }
}
