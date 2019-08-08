<?php

namespace App\Modules\Booking\Tasks\ClassBooking;

use App\Modules\Booking\Entities\BookingClass;
use App\Modules\Booking\Repositories\BookingClassRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetClassBookingTask extends AbstractTask
{

    /**
     * @var BookingClassRepository
     */
    private $repository;

    public function __construct(BookingClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->first();
    }

    public function getByField($field, $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }

    public function whereUserIs($value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('user_id', $value));
    }

    public function whereEventIs($value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('event_id', $value));
    }

    public function whereIsConfirmed()
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('confirm', BookingClass::$IS_CONFIRM));
    }
}
