<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\Booking\Entities\BookingClass;
use App\Modules\Booking\Repositories\BookingClassRepository;
use App\Ship\Abstraction\AbstractTask;

class SaveBookingTask extends AbstractTask
{
    /**
     * @var BookingClassRepository
     */
    private $bookingClassRepository;

    public function __construct(BookingClassRepository $bookingClassRepository)
    {
        $this->bookingClassRepository = $bookingClassRepository;
    }

    /**
     * @param array $attributes
     * @return BookingClass
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function run(array $attributes) :BookingClass
    {
        return $this->bookingClassRepository->create($attributes);
    }
}
