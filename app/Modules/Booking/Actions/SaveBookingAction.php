<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Tasks\SaveBookingTask;
use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaveBookingAction extends AbstractAction
{
    public function run(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $user = $this->call(GetAuthenticatedUserTask::class);

            $gymClass = $this->call(GetClassScheduleTask::class, [], [
                    [
                        'getByField' => ['id', $request->event_id]
                    ]
            ])->first();

            $this->setNewPersonToEvent($gymClass);

            return $this->call(SaveBookingTask::class, [
                $this->getDataForCreateBooking($request, $user)
            ]);
        });
    }

    private function getDataForCreateBooking(Request $request, User $user) :array
    {
        return [
            'event_id' => $request->event_id,
            'user_id' => $user->id
        ];
    }

    private function setNewPersonToEvent(ClassSchedule $classSchedule) :int
    {
        return $classSchedule->increment('count_persons');
    }
}
