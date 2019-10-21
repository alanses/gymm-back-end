<?php

namespace App\Modules\Booking\Http\Controllers;

use App\Modules\Booking\Actions\GetAllEventsForGymAction;
use App\Modules\Booking\Actions\GetPassedClassByUserAction;
use App\Modules\Booking\Transformers\ListAllClassSchedulesForGym;
use App\Modules\Booking\Transformers\PassedScheduleTransformer;
use App\Ship\Parents\ApiController;
use App\Modules\Booking\Actions\GetListClassSchedulesForGymAction;
use App\Modules\Booking\Actions\GetListClassSchedulesForUserBookingAction;
use App\Modules\Booking\Http\Requests\GetClassSchedulesRequest;
use App\Modules\Booking\Http\Requests\GetClassScheduleUserRequest;
use App\Modules\Booking\Transformers\ListClassSchedulesForGymTransformer;
use App\Modules\Booking\Transformers\ListClassSchedulesForUserTransformer;

class ClassScheduleController extends ApiController
{
    public function getClassSchedulesForGym(GetClassSchedulesRequest $request)
    {
        $listClassSchedules = $this->call(GetListClassSchedulesForGymAction::class, [$request]);

        return ListClassSchedulesForGymTransformer::collection($listClassSchedules);
    }

    public function getClassSchedulesForBooking(GetClassScheduleUserRequest $request)
    {
        $listClassSchedules = $this->call(GetListClassSchedulesForUserBookingAction::class, [$request]);

        return ListClassSchedulesForUserTransformer::collection($listClassSchedules);
    }

    public function getAllClassSchedulesForGym()
    {
        $listClassSchedules = $this->call(GetAllEventsForGymAction::class, []);

        return ListAllClassSchedulesForGym::collection($listClassSchedules);
    }

    public function getClassPassedByUser()
    {
        $passedSchedule = $this->call(GetPassedClassByUserAction::class);

        return new PassedScheduleTransformer($passedSchedule);

    }
}
