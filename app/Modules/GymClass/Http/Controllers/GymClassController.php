<?php

namespace App\Modules\GymClass\Http\Controllers;

use App\Modules\GymClass\Actions\CreateClassScheduleAction;
use App\Modules\GymClass\Actions\DeleteClassScheduleAction;
use App\Modules\GymClass\Actions\GetClassScheduleAction;
use App\Modules\GymClass\Actions\GetClassScheduleForUserAction;
use App\Modules\GymClass\Actions\GetDataForCreateGymClassAction;
use App\Modules\GymClass\Actions\GetListClassSchedulesWithUserFilterAction;
use App\Modules\GymClass\Http\Requests\ClassScheduleRequest;
use App\Modules\GymClass\Http\Requests\DeleteClassScheduleRequest;
use App\Modules\GymClass\Transformers\ClassScheduleForGymTransformer;
use App\Modules\GymClass\Transformers\ClassScheduleForUserTransformer;
use App\Modules\GymClass\Transformers\ClassSchedulesAfterSaveTransformer;
use App\Modules\GymClass\Transformers\ClassSchedulesWithUserFilterTransformer;
use App\Ship\Parents\ApiController;

class GymClassController extends ApiController
{
    /**
     * @param ClassScheduleRequest $request
     * @return ClassSchedulesAfterSaveTransformer
     */
    public function createClassSchedule(ClassScheduleRequest $request)
    {
        $classSchedule = $this->call(CreateClassScheduleAction::class, [$request]);

        return new ClassSchedulesAfterSaveTransformer($classSchedule);
    }

    /**
     * @param $id
     * @return ClassScheduleForGymTransformer
     */
    public function getClassScheduleForGym($id)
    {
        $classSchedule = $this->call(GetClassScheduleAction::class, [$id]);

        return new ClassScheduleForGymTransformer($classSchedule);
    }

    public function getDataForCreateGymClass()
    {
        $dataForCreateCourse = $this->call(GetDataForCreateGymClassAction::class);

        return $dataForCreateCourse;
    }

    public function getClassScheduleWithUserFilter()
    {
        $classSchedules = $this->call(GetListClassSchedulesWithUserFilterAction::class);

        return ClassSchedulesWithUserFilterTransformer::collection($classSchedules);
    }

    public function getClassScheduleForUser($id)
    {
        $classSchedule = $this->call(GetClassScheduleForUserAction::class, [$id]);

        return new ClassScheduleForUserTransformer($classSchedule);
    }

    public function deleteClassSchedule(DeleteClassScheduleRequest $request)
    {
        $this->call(DeleteClassScheduleAction::class, [$request->id]);

        return $this->success();
    }
}
