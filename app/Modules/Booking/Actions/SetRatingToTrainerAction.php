<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Gym\Repositories\RatingForTrainerRepository;
use App\Modules\Gym\Repositories\TrainerRepository;
use App\Ship\Abstraction\AbstractAction;

class SetRatingToTrainerAction extends AbstractAction
{
    /**
     * @var TrainerRepository
     */
    private $repository;

    public function __construct(RatingForTrainerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $attributes
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */

    public function run(array $attributes)
    {
        return $this->repository->create($attributes);
    }
}
