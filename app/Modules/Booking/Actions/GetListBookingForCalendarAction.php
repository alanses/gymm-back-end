<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Http\Requests\ListBookingForCalendarRequest;
use App\Modules\Booking\Tasks\GetListBookingForCalendarForUserTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class GetListBookingForCalendarAction extends AbstractAction
{
    public function run(ListBookingForCalendarRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $bookings = $this->call(GetListBookingForCalendarForUserTask::class, [], [
            ['whereUserIs' => [$user->id]],
            ['whereDate' => [$request->booking_date]]
        ]);

        return $bookings->load([
            'classSchedule' => function($query) {
                $query->with(
                    [
                        'trainer.avgRating',
                        'gym',
                        'activityType',
                    ]
                );
            }
        ]);
    }
}
