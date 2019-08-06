<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Tasks\SaveBookingTask;
use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class SaveBookingAction extends AbstractAction
{
    public function run(Request $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $gymClass = $this->call(GetClassScheduleTask::class, [], [
            [
                ['getByField' => ['id', $request->event_id]]
            ]
        ])->first();

        $gymClass->increment('count_persons', 1);

        return $this->call(SaveBookingTask::class, [$this->getDataForCreateBooking($request, $user)]);
    }

    private function getDataForCreateBooking(Request $request, User $user)
    {
        return [
            'event_id' => $request->event_id,
            'user_id' => $user->id
        ];
    }
}
