<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Entities\BookingClass;
use App\Modules\Booking\Http\Requests\RegisterUserNotPassClassRequest;
use App\Modules\Booking\Tasks\MakeVisitBookingTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class RegisterThatUserNotPassedClassAction extends AbstractAction
{
    public function run(RegisterUserNotPassClassRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        return $this->call(MakeVisitBookingTask::class, [$user, $request->schedule_id, BookingClass::$IS_NOT_CONFIRM]);
    }
}
