<?php

namespace App\Modules\Booking\Http\Controllers;

use App\Modules\Booking\Actions\GetListClassSchedulesForGymAction;
use App\Modules\Booking\Actions\GetListClassSchedulesForUserAction;
use App\Modules\Booking\Actions\SaveBookingAction;
use App\Modules\Booking\Http\Requests\GetClassSchedulesRequest;
use App\Modules\Booking\Http\Requests\GetClassScheduleUserRequest;
use App\Modules\Booking\Transformers\ListClassSchedulesForGymTransformer;
use App\Modules\Booking\Transformers\ListClassSchedulesForUserTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;

class BookingController extends ApiController
{
    public function getClassSchedulesForGym(GetClassSchedulesRequest $request)
    {
        $listClassSchedules = $this->call(GetListClassSchedulesForGymAction::class, [$request]);

        return ListClassSchedulesForGymTransformer::collection($listClassSchedules);
    }

    public function getClassSchedulesForUser(GetClassScheduleUserRequest $request)
    {
        $listClassSchedules = $this->call(GetListClassSchedulesForUserAction::class, [$request]);

        return ListClassSchedulesForUserTransformer::collection($listClassSchedules);
    }

    public function createBooking(Request $request)
    {
        $booking = $this->call(SaveBookingAction::class, [$request]);

        return $booking;
    }
}
