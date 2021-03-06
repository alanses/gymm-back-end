<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Http\Requests\SaveRateOfClassRequest;
use App\Modules\GymClass\Entities\ClassSchedule;
use App\Modules\GymClass\Tasks\GetClassScheduleTask;
use App\Modules\GymClass\Tasks\SaveClassScheduleDescriptionTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class SaveRateOfClassAction extends AbstractAction
{
    public function run(SaveRateOfClassRequest $request)
    {
        $classSchedule = $this->call(GetClassScheduleTask::class, [], [
            ['findByField' => ['id', $request->schedule_id]]
        ])->first();

        $user = $this->call(GetAuthenticatedUserTask::class);

        $this->checkIfEventHasPassed($classSchedule);

        $review = $this->call(SaveClassScheduleDescriptionTask::class, [
            $this->getDataForCreateClassScheduleDescription($user, $classSchedule, $request)
        ]);

        return $review;
    }

    private function getDataForCreateClassScheduleDescription(User $user,ClassSchedule $classSchedule, Request $request)
    {
        return [
            'user_id' => $user->id,
            'full_class_type_id' => $request->full_class_type_id,
            'class_schedule_id' =>  $classSchedule->id,
        ];
    }

    public function checkIfEventHasPassed(ClassSchedule $classSchedule)
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $startDate = $classSchedule->start_date;

        if($currentDate <= $startDate) {
            throw new AccessDeniedHttpException('Impossible to evaluate an event that has not yet occurred');
        }

        return true;
    }
}
