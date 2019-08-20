<?php

namespace App\Modules\Statistic\Actions\Gym;

use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class GetGymProfileStatisticSubAction extends AbstractAction
{
    public function run()
    {
        $data = [];

        $user = $this->call(GetAuthenticatedUserTask::class);
        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        $data['count_classes'] = $this->call(GetCountClassesAction::class, [$gym]);
        $data['count_clients'] = $this->call(GetCountClientsAction::class, [$gym]);
        $data['count_reviews'] = $this->call(GetCountReviewsAction::class, [$gym]);
        $data['count_trainers'] = $this->call(GetCountTrainersAction::class, [$gym]);

        return $data;
    }
}
