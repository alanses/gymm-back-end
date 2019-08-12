<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\Gym\Repositories\RatingForTrainerRepository;
use App\Ship\Abstraction\AbstractTask;

class SaveRatingToTrainerTask extends AbstractTask
{
    /**
     * @var RatingForTrainerRepository
     */
    private $repository;

    public function __construct(RatingForTrainerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $attributes)
    {
        return $this->repository->create($attributes);
    }
}
