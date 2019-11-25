<?php

namespace App\Modules\Location\Tasks;

use App\Modules\Location\Repositories\CitiesRepository;
use App\Modules\Location\Repositories\CountriesRepository;
use App\Ship\Abstraction\AbstractTask;

class CreateCityTask extends AbstractTask
{
    /**
     * @var CitiesRepository
     */
    private $repository;
    /**
     * @var CountriesRepository
     */
    private $countriesRepository;

    public function __construct(CitiesRepository $repository, CountriesRepository $countriesRepository)
    {
        $this->repository = $repository;
        $this->countriesRepository = $countriesRepository;
    }

    public function run(array $attributes)
    {
        $this->getIdKazakhstan($attributes); // TEMP SOLUTION
        return $this->repository->create($attributes);
    }

    private function getIdKazakhstan(&$attributes)
    {
        if($country = $this->countriesRepository->findWhere(['code' => 'KZ'])->first()) {
            $attributes['country_id'] = $country->id;
        }
    }
}
