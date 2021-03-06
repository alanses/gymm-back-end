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
            'class_info' => [
                'start_date' => $this->resource ? $this->getStartDate() : null,
                'day_of_week' => $this->resource ? $this->getDayOfWeekFromDate() : null,
                'start_time' => $this->resource ? $this->getStartTime() : null,
                'end_time' => $this->resource ? $this->getEndTime() : null,
                'lesson_time' => $this->resource ? $this->getLessonTime() : null,
                'activity_name' => $this->resource ? $this->getActivityName() : null,
                'address' => $this->resource ? $this->getAddress() : null,
                'count_credits' => $this->resource ? $this->getCountCredits() : null,
                'trainer_name' => $this->resource ? $this->getTrainerName() : null
            ],
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
