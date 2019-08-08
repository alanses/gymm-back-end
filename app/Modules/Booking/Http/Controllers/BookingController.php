<?php

namespace App\Modules\Booking\Http\Controllers;

use App\Modules\Booking\Actions\ConfirmBookingAction;
use App\Modules\Booking\Actions\GetListBookingForCalendarAction;
use App\Modules\Booking\Actions\SaveBookingAction;
use App\Modules\Booking\Http\Requests\BookingRequest;
use App\Modules\Booking\Http\Requests\ConfirmBookingRequest;
use App\Modules\Booking\Http\Requests\ListBookingForCalendarRequest;
use App\Modules\Booking\Transformers\BookingsForUserCalendar;
use App\Modules\Booking\Transformers\BookingTransformer;
use App\Ship\Parents\ApiController;

class BookingController extends ApiController
{
    public function createBooking(BookingRequest $request)
    {
        $booking = $this->call(SaveBookingAction::class, [$request]);

        return new BookingTransformer($booking);
    }

    public function confirmBooking(ConfirmBookingRequest $request)
    {
        $this->call(ConfirmBookingAction::class, [$request]);

        return $this->success('ok');
    }

    public function getListBookingForUserCalendar(ListBookingForCalendarRequest $request)
    {
        $bookigs = $this->call(GetListBookingForCalendarAction::class, [$request]);

        return BookingsForUserCalendar::collection($bookigs);
    }
}
