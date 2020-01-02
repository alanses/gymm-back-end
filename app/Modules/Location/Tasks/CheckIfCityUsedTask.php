<?php

namespace App\Modules\Location\Tasks;

use App\Modules\Location\Repositories\CitiesRepository;
use App\Ship\Abstraction\AbstractTask;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class CheckIfCityUsedTask extends AbstractTask
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
        $city = $this->repository->find($id);

        if($city->userSettings->isNotEmpty()) {
            throw new AccessDeniedHttpException('This city attached to users');
        }

        if($city->gyms->isNotEmpty()) {
            throw new AccessDeniedHttpException('This city attached to gyms');
        }
    }
}
