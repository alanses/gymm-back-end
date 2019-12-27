<?php

namespace App\Modules\Statistic\Actions\Gym;

use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\Statistic\Tasks\GetStatisticForPaymentsTask;
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

        $user = $this->call(GetAuthenticatedUserTask::class);
        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        $month = $this->getMouth($date);
        $year = $this->getYear($date);

        $data['count_classes'] = $this->call(GetStatisticForClassTask::class, [], [
            ['whereStartDateIs' => ['start_date', $month]],
            ['whereGymIS' => [$gym->id]],
            ['whereYearIS' => ['start_date', $year]]
        ]);

        $data['count_clients'] = $this->call(GetStatisticForClientsTask::class, [], [
            ['whereStartDateIs' => ['start_date', $month]],
            ['whereGymIS' => [$gym->id]],
            ['whereYearIS' => ['start_date', $year]]
        ]);

        $data['count_reviews'] = $this->call(GetStatisticForReviewsTask::class, [], [
            ['whereStartDateIs' => ['start_date', $month]],
            ['whereGymIS' => [$gym->id]],
            ['whereYearIS' => ['start_date', $year]]
        ]);

        $data['count_trainers'] = $data['count_classes']; // becouse 1 class has 1 trainer

        $data['count_payment'] = $this->call(GetStatisticForPaymentsTask::class, [], [
            ['whereStartDateIs' => ['created_at', $month]],
            ['whereGymIS' => [$gym->id]],
            ['whereYearIS' => ['created_at', $year]]
        ]);

        return $data;
    }

    private function getMouth(string $date)
    {
        $date = explode('-', $date);

        return $date[0];
    }

    private function getYear(string $date)
    {
        $date = explode('-', $date);

        return $date[1];
    }
}
