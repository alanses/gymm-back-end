<?php

namespace App\Modules\Gym\Tasks\Trainers;

use App\Modules\Gym\Repositories\TrainerRepository;
use App\Ship\Abstraction\AbstractTask;

class DeleteTrainerTask extends AbstractTask
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
        return $this->trainerRepository->delete($id);
    }
}
