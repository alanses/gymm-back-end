<?php

namespace App\Modules\Booking\Tasks\ClassBooking;

use App\Modules\Booking\Repositories\BookingClassRepository;
use App\Ship\Abstraction\AbstractTask;

class UpdateClassBookingTask extends AbstractTask
{
    /**
     * @var BookingClassRepository
     */
    private $repository;

    public function __construct(BookingClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $attributes, $id)
    {
        return $this->repository->update($attributes, $id);
    }
}
