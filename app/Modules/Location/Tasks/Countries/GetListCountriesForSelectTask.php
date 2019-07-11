<?php

namespace App\Modules\Location\Tasks\Countries;

use App\Modules\Location\Repositories\CountriesRepository;
use App\Ship\Abstraction\AbstractTask;

class GetListCountriesForSelectTask extends AbstractTask
{
    /**
     * @var CountriesRepository
     */
    private $countriesRepository;

    public function __construct(CountriesRepository $countriesRepository)
    {
        $this->countriesRepository = $countriesRepository;
    }

    public function run()
    {
        return $this->countriesRepository->getDataForSelect(['id', 'name']);
    }
}
