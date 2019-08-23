<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Entities\BookingClass;
use App\Modules\Booking\Http\Requests\ConfirmBookingRequest;
use App\Modules\Booking\Tasks\ClassBooking\GetClassBookingTask;
use App\Modules\Booking\Tasks\ClassBooking\UpdateClassBookingTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Modules\UserProfile\Entities\UserSetting;
use App\Ship\Abstraction\AbstractAction;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ConfirmBookingAction extends AbstractAction
{
    public function run(ConfirmBookingRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);
        $userSetting = $user->userSetting;

        $booking = $this->call(GetClassBookingTask::class, [], [
            ['getByField' => ['id', $request->booking_id]]
        ]);

        if($booking->confirm == BookingClass::$IS_CONFIRM) {
            throw new AccessDeniedHttpException('User has been confirm application');
        }

        $booking->update(['confirm' => BookingClass::$IS_CONFIRM]);

        $this->updateCountPersons($booking, $userSetting);

        //TODO::make remove points from account
    }

    private function updateCountPersons(BookingClass $bookingClass, UserSetting $setting)
    {
        if($classSchedule = $bookingClass->classSchedule) {
            $classSchedule->update([
                'count_persons' => $classSchedule->count_persons + $setting->spots
            ]);
        }
    }
}
