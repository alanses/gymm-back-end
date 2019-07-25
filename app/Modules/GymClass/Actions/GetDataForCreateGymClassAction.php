<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\Activities\Tasks\GetActivitiesTask;
use App\Modules\Gym\Tasks\GetTrainersForSelectTask;
use App\Modules\GymClass\Tasks\GetClassTypesTask;
use App\Modules\GymClass\Tasks\GetRepeatsTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class GetDataForCreateGymClassAction extends AbstractAction
{
    private $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $gym = $user->gym;

        $this->data['trainers'] = $this->call(GetTrainersForSelectTask::class, [], [
            [
                'getByField' => ['gym_id', $gym->id]
            ]
        ]);

        $this->data['activities'] = $this->call(GetActivitiesTask::class);

        $this->data['class_types'] = $this->call(GetClassTypesTask::class);

        $this->data['repeat'] = $this->call(GetRepeatsTask::class, [], [
            [
                'setSelectedFields' => [['id', 'displayed_name', 'recurring_type']]
            ]
        ]);

        return $this->data;
    }
}
