<?php

namespace App\Modules\Location\Repositories;

use App\Modules\Location\Entities\Countries;
use App\Ship\Abstraction\AbstractRepository;
use App\Ship\Traits\DataForSelect;


class CountriesRepository extends AbstractRepository
{
    use DataForSelect;

    protected $fieldSearchable = [];

    /**
    * @throws \Prettus\Repository\Exceptions\RepositoryException
    */
    public function boot()
    {

    }

    /**
    * @return string
    */
    function model()
    {
        return Countries::class;
    }
}
