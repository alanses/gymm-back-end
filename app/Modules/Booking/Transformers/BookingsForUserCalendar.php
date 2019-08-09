<?php

namespace App\Modules\Booking\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class BookingsForUserCalendar extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'address' => $this->getAddress(),
            'activity_type' => $this->getActivityType(),
            'trainer' => $this->getTrainer(),
            'avg_rating' => $this->getAvgRating(),
            'start_time' => $this->getStartTime(),
            'end_time' => $this->getEndTime(),
            'lesson_time' => $this->getLessonTime(),
            'credits' => $this->credits
        ];
    }

    private function getCountPersons()
    {
        if($classSchedule = $this->classSchedule) {
            return $classSchedule->max_count_persons;
        }
    }

    private function getAvgRating()
    {
        if($classSchedule = $this->classSchedule) {
            if ($trainer = $classSchedule->trainer) {
                $avg = $trainer->avgRating;

                if ($avg->isNotEmpty()) {
                    return $avg
                        ->first()
                        ->aggregate;
                }

                return 0;
            }
        }
    }

    private function getTrainer()
    {
        if($classSchedule = $this->classSchedule) {
            return optional($classSchedule->trainer)->trainer_name;
        }
    }

    private function getAddress()
    {
        if($classSchedule = $this->classSchedule) {
            return optional($classSchedule->gym)->address;
        }
    }

    private function getActivityType()
    {
        if($classSchedule = $this->classSchedule) {
            return optional($classSchedule->activityType)->displayed_name;
        }
    }

    private function getStartTime()
    {
        if($classSchedule = $this->classSchedule) {
            if($classSchedule->start_time) {
                return Carbon::parse($classSchedule->start_time)->format('H:i');
            }
        }
    }

    private function getEndTime()
    {
        if($classSchedule = $this->classSchedule) {
            if($classSchedule->end_time) {
                return Carbon::parse($classSchedule->end_time)->format('H:i');
            }
        }
    }

    private function getLessonTime()
    {
        if($this->classSchedule->start_time && $this->classSchedule->end_time) {
            $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->classSchedule->start_time);
            $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->classSchedule->end_time);

            return $start_time->diffInMinutes($end_time);
        }
    }
}
