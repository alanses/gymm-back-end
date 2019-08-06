<?php

namespace App\Modules\Booking\Http\Controllers;

use App\Modules\Booking\Actions\GetListClassSchedulesAction;
use App\Modules\Booking\Actions\SaveBookingAction;
use App\Modules\Booking\Transformers\ListClassSchedulesTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;

class BookingController extends ApiController
{
    public function getClassSchedules(Request $request)
    {
        $listClassSchedules = $this->call(GetListClassSchedulesAction::class, [$request]);

        return ListClassSchedulesTransformer::collection($listClassSchedules);
    }

    public function createBooking(Request $request)
    {
        $booking = $this->call(SaveBookingAction::class, [$request]);

        return $booking;
    }
}
