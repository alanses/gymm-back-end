<?php

namespace App\Modules\GymClass\Actions;

use App\Modules\Gym\Entities\Gym;
use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\GymClass\Http\Requests\ClassScheduleRequest;
use App\Modules\GymClass\Services\DateHelperService;
use App\Modules\GymClass\Tasks\CreateClassScheduleTask;
use App\Modules\GymClass\Tasks\GetLastClassScheduleTask;
use App\Modules\Photos\Tasks\UploadPhotoToClassScheduleTask;
use App\Modules\Photos\Entities\Photo;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;
use Carbon\Carbon;
use DateTime;

class CreateClassScheduleAction extends AbstractAction
{
    private $dateHelperService;
    private $classSchedules;
    private $photo;

    public function __construct(DateHelperService $dateHelperService)
    {
        $this->dateHelperService = $dateHelperService;
        $this->classSchedules = [];
        $this->photo = null;
    }

    public function run(ClassScheduleRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);
        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        if($request->photo) {
            $this->photo = $this->call(UploadPhotoToClassScheduleTask::class, [
                $request->photo,
                $user->id,
                Photo::getBasePathForSchedule()
            ]);
        }

        $event = $this->call(CreateClassScheduleEventAction::class, [
            $this->getDataForCreateEvent($request, $gym, $this->photo)
        ]);

        foreach ($this->dateHelperService->generateListDates($request) as $item)
        {
            array_push($this->classSchedules, $this->getData($request, $item, $gym, $event, $this->photo));
        }

        $this->call(CreateClassScheduleTask::class, [
            $this->classSchedules
        ]);

        $classSchedule = $this->call(GetLastClassScheduleTask::class);

        return $classSchedule;
    }

    private function getData(ClassScheduleRequest $request, DateTime $dateTime, Gym $gym, $event, ?array $photo)
    {
        return [
            'class_type_id' => $request->class_type_id,
            'activities_id' => $request->activities_id,
            'level' => $request->level,
            'credits' => $request->credits,
            'start_date' => $dateTime->format('Y-m-d'),
            'start_time' => Carbon::parse($request->start_time)->toDateTimeString(),
            'end_date' => null,
            'trainer_id' => $request->trainer_id,
            'end_time' => Carbon::parse($request->end_time)->toDateTimeString(),
            'is_recurring' => $this->getIsRecurring($request),
            'recurring_type_id' => $this->getRecurringType($request),
            'max_count_persons' => $request->count_persons,
            'gym_id' => $gym->id,
            'file_name' => $this->getFileName($photo),
            'origin_name' => $this->getOriginName($photo),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'class_schedule_event_id' => $event->id,
            'description' => $request->description
        ];
    }

    private function getDataForCreateEvent(ClassScheduleRequest $request, Gym $gym, ?array $photo)
    {
        return [
            'class_type_id' => $request->class_type_id,
            'activities_id' => $request->activities_id,
            'level' => $request->level,
            'credits' => $request->credits,
            'start_date' => $request->start_date,
            'start_time' => Carbon::parse($request->start_time)->toDateTimeString(),
            'end_date' => null,
            'trainer_id' => $request->trainer_id,
            'end_time' => Carbon::parse($request->end_time)->toDateTimeString(),
            'is_recurring' => $this->getIsRecurring($request),
            'recurring_type_id' => $this->getRecurringType($request),
            'max_count_persons' => $request->count_persons,
            'gym_id' => $gym->id,
            'file_name' => $this->getFileName($photo),
            'origin_name' => $this->getOriginName($photo),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
            'description' => $request->description
        ];
    }

    private function getRecurringType(ClassScheduleRequest $request)
    {
        return $request->repeat;
    }

    private function getFileName(?array $photo)
    {
        if(is_null($photo)) {
            return null;
        }

        return array_key_exists('file_name', $photo) ? $photo['file_name'] : null;
    }

    private function getOriginName(?array $photo)
    {
        if(is_null($photo)) {
            return null;
        }

        return array_key_exists('origin_name', $photo) ? $photo['origin_name'] : null;
    }

    /**
     * @param ClassScheduleRequest $request
     * @return string
     */
    public function getIsRecurring(ClassScheduleRequest $request) :string
    {
        return $request->repeat ? 'Y' : 'N';
    }
}
