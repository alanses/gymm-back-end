<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Entities\BookingClass;
use App\Modules\Booking\Tasks\ClassBooking\GetClassBookingTask;
use App\Modules\Booking\Tasks\SaveBookingTask;
use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class SaveBookingAction extends AbstractAction
{
    public function run(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $user = $this->call(GetAuthenticatedUserTask::class);

            $this->validateBookingBeforeSave($user, $request);

            $gymClass = $this->call(GetClassScheduleTask::class, [], [
                    [
                        'getByField' => ['id', $request->event_id]
                    ]
            ])->first();

            $this->setNewPersonToEvent($gymClass);

            $booking = $this->call(SaveBookingTask::class, [
                $this->getDataForCreateBooking($request, $user)
            ]);

            return $booking->load(['classSchedule' => function($query) {
                $query->with(['classType', 'activityType', 'trainer', 'gym']);
            }]);
        });
    }

    private function getDataForCreateBooking(Request $request, User $user) :array
    {
        return [
            'event_id' => $request->event_id,
            'user_id' => $user->id,
            'confirm' => BookingClass::$IS_NOT_CONFIRM
        ];
    }

    private function setNewPersonToEvent(ClassSchedule $classSchedule) :int
    {
        return $classSchedule->increment('count_persons');
    }

    protected function validateBookingBeforeSave(User $user, Request $request)
    {
        $this->checkIfUserBookingEventBefore($user, $request);
        $this->checkMaxBookingCount($request);
    }

    private function checkIfUserBookingEventBefore(User $user, Request $request)
    {
        $events = $this->call(GetClassBookingTask::class, [], [
            ['whereUserIs' => [$user->id]],
            ['whereEventIs' => [$request->event_id]],
            ['whereIsConfirmed' => []]
        ]);

        if($events) {
            throw new AccessDeniedHttpException('You have already created booking on this event');
        }
    }

    private function checkMaxBookingCount(Request $request)
    {
        $classSchedule = $this->call(GetClassScheduleTask::class, [], [
            ['getByField' => ['id', $request->event_id]]
        ])->first();

        if($classSchedule->count_persons >= $classSchedule->max_count_persons) {
            throw new AccessDeniedHttpException('Event has max count persons');
        }
    }
}
