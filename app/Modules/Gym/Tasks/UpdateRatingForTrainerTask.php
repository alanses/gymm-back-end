<?php

namespace App\Modules\Gym\Tasks;

use App\Modules\Gym\Repositories\RatingForTrainerRepository;
use App\Ship\Abstraction\AbstractTask;

class UpdateRatingForTrainerTask extends AbstractTask
{
    /**
     * @var RatingForTrainerRepository
     */
    private $repository;

    public function __construct(RatingForTrainerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $attributes, $id)
    {
        return $this->repository->update($attributes, $id);
    }
}
