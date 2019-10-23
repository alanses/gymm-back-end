<?php

namespace App\Modules\GymClass\Tasks;

use App\Modules\Gym\Repositories\RatingForTrainerRepository;
use App\Modules\Gym\Repositories\TrainerRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetReviewTask extends AbstractTask
{
    /**
     * @var TrainerRepository
     */
    private $ratingForTrainerRepository;

    public function __construct(RatingForTrainerRepository $ratingForTrainerRepository)
    {
        $this->ratingForTrainerRepository = $ratingForTrainerRepository;
    }

    public function run()
    {
        return $this->ratingForTrainerRepository->first();
    }

    public function findByField($field, $value)
    {
        $this->ratingForTrainerRepository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }
}
