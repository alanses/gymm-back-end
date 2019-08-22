<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\Booking\Repositories\BookingClassRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\FindByRelationCriteria;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetListBookingForCalendarForUserTask extends AbstractTask
{
    private $repository;

    public function __construct(BookingClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->get();
    }

    public function whereUserIs($value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('user_id', $value));
    }

    public function whereDate($date)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria('booking_date', $date));
    }
}
