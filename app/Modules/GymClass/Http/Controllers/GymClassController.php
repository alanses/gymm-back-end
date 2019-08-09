<?php

namespace App\Modules\GymClass\Http\Controllers;

use App\Modules\GymClass\Actions\CreateClassScheduleAction;
use App\Modules\GymClass\Actions\GetClassAttachedToGymAction;
use App\Modules\GymClass\Actions\GetClassesListAction;
use App\Modules\GymClass\Actions\GetClassScheduleAction;
use App\Modules\GymClass\Actions\GetDataForCreateGymClassAction;
use App\Modules\GymClass\Actions\GetListClassesWithUserFilterAction;
use App\Modules\GymClass\Http\Requests\ClassesAttachedToGymRequest;
use App\Modules\GymClass\Http\Requests\ClassScheduleRequest;
use App\Modules\GymClass\Transformers\ClassSchedulesCollection;
use App\Modules\GymClass\Transformers\ListClassesTransformer;
use App\Modules\GymClass\Transformers\ListClassSchedulesTransformer;
use App\Ship\Parents\ApiController;

class GymClassController extends ApiController
{
    /**
     * @param ClassScheduleRequest $request
     * @return ClassSchedulesCollection
     */
    public function createClassSchedule(ClassScheduleRequest $request)
    {
        $classSchedule = $this->call(CreateClassScheduleAction::class, [$request]);

        return new ClassSchedulesCollection($classSchedule);
    }

    /**
     * @param $id
     * @return ClassSchedulesCollection
     */
    public function getClassSchedule($id)
    {
        $classSchedule = $this->call(GetClassScheduleAction::class, [$id]);

        return new ClassSchedulesCollection($classSchedule);
    }

    public function getDataForCreateGymClass()
    {
        $dataForCreateCourse = $this->call(GetDataForCreateGymClassAction::class);

        return $dataForCreateCourse;
    }

    public function getClassesAttachedToGym(ClassesAttachedToGymRequest $classesAttachedToGymRequest)
    {
        $classSchedules = $this->call(GetClassAttachedToGymAction::class, [
            $classesAttachedToGymRequest->gym_id
        ]);

        return ListClassSchedulesTransformer::collection($classSchedules);
    }

    public function getListClasses()
    {
        $classSchedules = $this->call(GetClassesListAction::class);

        return ListClassesTransformer::collection($classSchedules);
    }
}
