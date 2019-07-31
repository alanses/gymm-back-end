<?php

namespace App\Modules\Gym\Tasks\Trainers;

use App\Modules\Gym\Entities\Trainer;
use App\Modules\Gym\Repositories\TrainerRepository;
use App\Ship\Abstraction\AbstractTask;

class CreateTrainerTask extends AbstractTask
{

    /**
     * @var TrainerRepository
     */
    private $trainerRepository;

    public function __construct(TrainerRepository $trainerRepository)
    {
        $this->trainerRepository = $trainerRepository;
    }


    /**
     * @param array $attributes
     * @return Trainer
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function run(array $attributes) :Trainer
    {
        return $this->trainerRepository->create($attributes);
    }

}
