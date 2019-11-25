<?php

namespace App\Modules\Location\Tasks;

use App\Modules\Location\Repositories\CitiesRepository;
use App\Ship\Abstraction\AbstractTask;

class DeleteCityTask extends AbstractTask
{
    /**
     * @var CitiesRepository
     */
    private $repository;

    public function __construct(CitiesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        return $this->repository->delete($id);
    }
}
