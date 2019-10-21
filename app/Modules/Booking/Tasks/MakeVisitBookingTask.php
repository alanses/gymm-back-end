<?php

namespace App\Modules\Booking\Tasks;

use App\Modules\Booking\Repositories\BookingClassRepository;
use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class MakeVisitBookingTask extends AbstractTask
{
    /**
     * @var BookingClassRepository
     */
    private $repository;

    public function __construct(BookingClassRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(User $user, $schedule_id)
    {
        $booking = $this->repository->findWhere([
            'user_id' => $user->id,
            'event_id' => $schedule_id
        ])->first();

        $booking->update([
            'passed' => 1,
            'visited_by_user' => 1
        ]);
    }
}
