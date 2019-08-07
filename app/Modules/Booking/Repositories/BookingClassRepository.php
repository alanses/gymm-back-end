<?php

namespace App\Modules\Booking\Repositories;

use App\Modules\Booking\Entities\BookingClass;
use App\Ship\Abstraction\AbstractRepository;

class BookingClassRepository extends AbstractRepository
{
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
        return BookingClass::class;
    }
}
