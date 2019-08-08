<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Entities\BookingClass;
use App\Modules\Booking\Http\Requests\ConfirmBookingRequest;
use App\Modules\Booking\Tasks\ClassBooking\UpdateClassBookingTask;
use App\Ship\Abstraction\AbstractAction;

class ConfirmBookingAction extends AbstractAction
{
    public function run(ConfirmBookingRequest $request)
    {
        $this->call(UpdateClassBookingTask::class, [
            $this->getDataForConfirmBooking(),
            $request->booking_id
        ]);

        //TODO::make remove points from account
    }

    private function getDataForConfirmBooking()
    {
        return [
            'confirm' => BookingClass::$IS_CONFIRM,
        ];
    }
}
