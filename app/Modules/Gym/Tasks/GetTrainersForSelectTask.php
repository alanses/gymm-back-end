<?php

namespace App\Modules\Gym\Tasks;

use App\Modules\Gym\Repositories\TrainerRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetTrainersForSelectTask extends AbstractTask
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
        return $this->trainerRepository->all();
    }

    public function getByField(string $fieldName, string $value)
    {
        $this->trainerRepository->pushCriteria(new ThisEqualThatCriteria($fieldName, $value));
    }
}
