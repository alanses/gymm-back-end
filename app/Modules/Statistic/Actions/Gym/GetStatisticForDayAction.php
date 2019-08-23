<?php

namespace App\Modules\Statistic\Actions;

use App\Ship\Abstraction\AbstractAction;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Modules\Gym\Tasks\GetGymFromUserTask;

class GetStatisticForDayAction extends AbstractAction
{
    public function run(string $monthName)
    {
        $data = [];

        $user = $this->call(GetAuthenticatedUserTask::class);
        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        $data['count_classes'] = $this->call(GetStatisticForClassTask::class, [], [
            ['whereStartDateIs' => ['start_date', $monthName]],
            ['whereGymIS' => [$gym->id]]
        ]);

        $data['count_clients'] = $this->call(GetStatisticForClientsTask::class, [], [
            ['whereStartDateIs' => ['start_date', $monthName]],
            ['whereGymIS' => [$gym->id]]
        ]);

        $data['count_reviews'] = $this->call(GetStatisticForReviewsTask::class, [], [
            ['whereStartDateIs' => ['start_date', $monthName]],
            ['whereGymIS' => [$gym->id]]
        ]);

        $data['count_trainers'] = $data['count_classes']; // becouse 1 class has 1 trainer

        return $data;
    }
}
