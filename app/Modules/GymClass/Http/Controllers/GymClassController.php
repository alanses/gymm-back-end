<?php

namespace App\Modules\GymClass\Http\Controllers;

use App\Modules\GymClass\Actions\CreateClassScheduleAction;
use App\Modules\GymClass\Actions\GetClassScheduleAction;
use App\Modules\GymClass\Actions\GetDataForCreateGymClassAction;
use App\Modules\GymClass\Http\Requests\ClassScheduleRequest;
use App\Modules\GymClass\Transformers\ClassSchedulesCollection;
use App\Modules\GymClass\Transformers\ListDataForCreateGymClassTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;

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
}