<?php

namespace App\Modules\Location\Repositories;

use App\Modules\Location\Entities\Cities;
use App\Ship\Abstraction\AbstractRepository;
use App\Ship\Traits\DataForSelect;

class CitiesRepository extends AbstractRepository
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
        return Cities::class;
    }
}
