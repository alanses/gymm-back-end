<?php

namespace App\Modules\Gym\Actions;

use App\Modules\Gym\Repositories\TrainerRepository;
use App\Modules\Gym\Tasks\FindGymTask;
use App\Modules\Gym\Tasks\GetTrainersForSelectTask;
use App\Ship\Abstraction\AbstractAction;

class GetListTrainersForSelectAction extends AbstractAction
{
    /**
     * @var TrainerRepository
     */
    private $trainerRepository;

    public function __construct(TrainerRepository $trainerRepository)
    {
        $this->trainerRepository = $trainerRepository;
    }

    public function run($id)
    {
        $gym = $this->call(FindGymTask::class, [], [
            [
                'getByField' => ['user_id', $id]
            ]
        ]);

        return $this->call(GetTrainersForSelectTask::class, [], [
            [
                'getByField' => ['gym_id', $gym->id]
            ]
        ]);
    }
}
