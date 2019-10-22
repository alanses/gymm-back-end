<?php

namespace App\Modules\Booking\Http\Controllers;

use App\Modules\Booking\Actions\ConfirmBookingAction;
use App\Modules\Booking\Actions\GetBookingPreviewAction;
use App\Modules\Booking\Actions\GetListBookingForCalendarAction;
use App\Modules\Booking\Actions\RegisterThatUserNotPassedClassAction;
use App\Modules\Booking\Actions\RemoveBookingAction;
use App\Modules\Booking\Actions\SaveBookingAction;
use App\Modules\Booking\Http\Requests\BookingRequest;
use App\Modules\Booking\Http\Requests\ConfirmBookingRequest;
use App\Modules\Booking\Http\Requests\ListBookingForCalendarRequest;
use App\Modules\Booking\Http\Requests\RegisterUserNotPassClassRequest;
use App\Modules\Booking\Http\Requests\RemoveBookingRequest;
use App\Modules\Booking\Transformers\BookingPreviewTransformer;
use App\Modules\Booking\Transformers\BookingsForUserCalendar;
use App\Modules\Booking\Transformers\BookingTransformer;
use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Ship\Parents\ApiController;

class BookingController extends ApiController
{
    public function createBooking(BookingRequest $request)
    {
        $booking = $this->call(SaveBookingAction::class, [$request]);

        return new BookingTransformer($booking);
    }

    public function getBookingInfo($id)
    {
        $classSchedule = $this->call(GetBookingPreviewAction::class, [$id]);

        return new BookingPreviewTransformer($classSchedule);
    }

    public function confirmBooking(ConfirmBookingRequest $request)
    {
        $this->call(ConfirmBookingAction::class, [$request]);

        return $this->success('ok');
    }

    public function removeBooking(RemoveBookingRequest $request)
    {
        $this->call(RemoveBookingAction::class, [$request]);

        return $this->success();
    }

    public function getListBookingForUserCalendar(ListBookingForCalendarRequest $request)
    {
        $bookigs = $this->call(GetListBookingForCalendarAction::class, [$request]);

        return BookingsForUserCalendar::collection($bookigs);
    }
}
