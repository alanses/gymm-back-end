<?php

namespace App\Modules\Statistic\Actions\Gym;

use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\Statistic\Tasks\Gym\GetStatisticForClassTask;
use App\Modules\Statistic\Tasks\Gym\GetStatisticForClientsTask;
use App\Modules\Statistic\Tasks\Gym\GetStatisticForReviewsTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class GetStatisticForMouthAction extends AbstractAction
{
    public function run(string $date)
    {
        $data = [];

        dd($date);

        $user = $this->call(GetAuthenticatedUserTask::class);
        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        $data['count_classes'] = $this->call(GetStatisticForClassTask::class, [], [
            ['findByField' => ['start_date', $monthName]],
            ['whereGymIS' => [$gym->id]]
        ]);

        $data['count_clients'] = $this->call(GetStatisticForClientsTask::class, [], [
            ['findByField' => ['start_date', $monthName]],
            ['whereGymIS' => [$gym->id]]
        ]);

        $data['count_reviews'] = $this->call(GetStatisticForReviewsTask::class, [], [
            ['findByField' => ['start_date', $monthName]],
            ['whereGymIS' => [$gym->id]]
        ]);

        $data['count_trainers'] = $data['count_classes']; // becouse 1 class has 1 trainer

        return $data;
    }
}
