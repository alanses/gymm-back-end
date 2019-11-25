<?php

namespace App\Modules\Location\Tasks;

use App\Modules\Location\Repositories\CitiesRepository;
use App\Ship\Abstraction\AbstractTask;

class UpdateCityTask extends AbstractTask
{
    /**
     * @var CitiesRepository
     */
    private $repository;

    public function __construct(CitiesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($attributes, $id)
    {
        return $this->repository->update($attributes, $id);
    }
}
