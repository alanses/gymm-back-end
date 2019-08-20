<?php

namespace App\Modules\Gym\Actions;

use App\Modules\Gym\Repositories\TrainerRepository;
use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
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

    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        return $gym->trainers;
    }
}
