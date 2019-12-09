<?php

namespace App\Modules\Gym\Tasks\Trainers;

use App\Modules\Gym\Repositories\TrainerRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class FindTrainerTask extends AbstractTask
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
        return $this->trainerRepository->first();
    }

    /**
     * @param string $fieldName
     * @param string $value
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */

    public function getByField(string $fieldName, string $value)
    {
        $this->trainerRepository->pushCriteria(new ThisEqualThatCriteria($fieldName, $value));
    }

    /**
     * @return TrainerRepository
     */
    public function withRelations()
    {
        return $this->trainerRepository->with('activities');
    }

    public function withCountClassSchedules()
    {
        $this->trainerRepository->withCount('classSchedules');
    }
}
