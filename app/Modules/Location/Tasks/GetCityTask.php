<?php

namespace App\Modules\Location\Tasks;

use App\Modules\Location\Repositories\CitiesRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetCityTask extends AbstractTask
{
    /**
     * @var CitiesRepository
     */
    private $repository;

    public function __construct(CitiesRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->first();
    }

    public function findByField(string $field, string $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }
}
