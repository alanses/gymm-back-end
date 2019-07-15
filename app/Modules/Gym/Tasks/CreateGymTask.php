<?php

namespace App\Modules\Gym\Tasks;

use App\Modules\Gym\Repositories\GymRepository;
use App\Ship\Abstraction\AbstractTask;

class CreateGymTask extends AbstractTask
{
    /**
     * @var GymRepository
     */
    private $gymRepository;

    public function __construct(GymRepository $gymRepository)
    {
        $this->gymRepository = $gymRepository;
    }

    /**
     * @param array $attributes
     * @return mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function run(array $attributes)
    {
        return $this->gymRepository->create($attributes);
    }
}
