<?php

namespace App\Modules\Location\Tasks\Cities;

use App\Modules\Location\Repositories\CitiesRepository;
use App\Ship\Abstraction\AbstractTask;

class GetListCitiesForSelectTask extends AbstractTask
{
    /**
     * @var CitiesRepository
     */
    private $citiesRepository;

    public function __construct(CitiesRepository $citiesRepository)
    {
        $this->citiesRepository = $citiesRepository;
    }

    public function run()
    {
        return $this->citiesRepository->getDataForSelect(['id', 'name']);
    }
}
