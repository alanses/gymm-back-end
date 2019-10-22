<?php

namespace App\Modules\Booking\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class PassedScheduleTransformer extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource ? $this->event_id : null,
            'start_date' => $this->getStartDate(),
            'day_of_week' => $this->getDayOfWeekFromDate(),
            'start_time' => $this->getStartTime(),
            'end_time' => $this->getEndTime(),
            'lesson_time' => $this->getLessonTime(),
            'activity_name' => $this->getActivityName(),
            'address' => $this->getAddress(),
            'count_credits' => $this->getCountCredits(),
            'trainer_name' => $this->getTrainerName()
        ];
    }

    private function getStartDate()
    {
        return optional($this->classSchedule)->start_date;
    }

    private function getStartTime()
    {
        if($classSchedule = $this->classSchedule) {
            return Carbon::parse($classSchedule->start_time)->format('H:i');
        }
    }

    private function getEndTime()
    {
        if($classSchedule = $this->classSchedule) {
            return Carbon::parse($classSchedule->end_time)->format('H:i');
        }
    }

    private function getLessonTime()
    {
        if($classSchedule = $this->classSchedule) {
            $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $classSchedule->start_time);
            $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $classSchedule->end_time);

            return $start_time->diffInMinutes($end_time);
        }
    }

    private function getDayOfWeekFromDate()
    {
        if($classSchedule = $this->classSchedule) {
            return Carbon::parse($classSchedule->start_date)->format('l');
        }
    }

    private function getActivityName()
    {
        if($classSchedule = $this->classSchedule) {
            return optional($classSchedule->activityType)->name;
        }
    }

    private function getAddress()
    {
        if($classSchedule = $this->classSchedule) {
            return optional($classSchedule->gym)->address;
        }
    }

    private function getCountCredits()
    {
        return optional($this->classSchedule)->credits;
    }

    private function getTrainerName()
    {
        if($classSchedule = $this->classSchedule) {
            return optional($classSchedule->trainer)->trainer_name;
        }
    }
}
