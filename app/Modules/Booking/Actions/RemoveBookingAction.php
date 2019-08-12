<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Http\Requests\RemoveBookingRequest;
use App\Modules\Booking\Tasks\RemoveBookingTask;
use App\Ship\Abstraction\AbstractAction;

class RemoveBookingAction extends AbstractAction
{
    public function run(RemoveBookingRequest $request)
    {
        return $this->call(RemoveBookingTask::class, [$request->id]);
    }
}
