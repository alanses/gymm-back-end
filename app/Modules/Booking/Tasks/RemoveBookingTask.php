<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\Booking\Repositories\BookingClassRepository;
use App\Ship\Abstraction\AbstractTask;

class RemoveBookingTask extends AbstractTask
{
    /**
     * @var BookingClassRepository
     */
    private $repository;

    public function __construct(BookingClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        return $this->repository->deleteWhere(['id' => $id]);
    }
}
