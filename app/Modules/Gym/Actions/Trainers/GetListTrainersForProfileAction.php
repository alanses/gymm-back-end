<?php

namespace App\Modules\Gym\Actions\Trainers;

use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\Gym\Tasks\Trainers\ConvertTrainersFieldsTask;
use App\Modules\Gym\Tasks\Trainers\GetTrainersForProfileTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class GetListTrainersForProfileAction extends AbstractAction
{
    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        $trainers = $this->call(GetTrainersForProfileTask::class, [$gym], [
            [
                'setSelectedFields' => [['id', 'trainer_name']]
            ]
        ]);

        return $this->call(ConvertTrainersFieldsTask::class, [$trainers]);
    }
}
