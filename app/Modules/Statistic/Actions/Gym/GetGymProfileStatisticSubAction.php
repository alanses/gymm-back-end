<?php

namespace App\Modules\Statistic\Actions\Gym;

use App\Ship\Abstraction\AbstractAction;

class GetGymProfileStatisticSubAction extends AbstractAction
{
    public function run()
    {
        $data = [];

        $data['count_classes'] = $this->call(GetCountClassesAction::class);
        $data['count_clients'] = $this->call(GetCountClientsAction::class);
        $data['count_reviews'] = $this->call(GetCountReviewsAction::class);
        $data['count_trainers'] = $this->call(GetCountTrainersAction::class);

        return $data;
    }
}
