<?php

namespace App\Modules\Booking\Http\Controllers;

use App\Ship\Parents\ApiController;
use App\Modules\Booking\Actions\GetListClassSchedulesForGymAction;
use App\Modules\Booking\Actions\GetListClassSchedulesForUserAction;
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

    public function getClassSchedulesForUser(GetClassScheduleUserRequest $request)
    {
        $listClassSchedules = $this->call(GetListClassSchedulesForUserAction::class, [$request]);

        return ListClassSchedulesForUserTransformer::collection($listClassSchedules);
    }
}
