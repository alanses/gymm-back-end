<?php

namespace App\Modules\Statistic\Actions\Gym;

use App\Ship\Abstraction\AbstractAction;

class GetGymProfileStatisticSubAction extends AbstractAction
{
    public function run()
    {
        $data = [];

        $data['count_trainers'] = $this->call(GetCountTrainersAction::class);

        return $data;
    }
}
