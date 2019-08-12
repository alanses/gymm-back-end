<?php

namespace App\Modules\Booking\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Carbon\Carbon;

class ListClassSchedulesForGymTransformer extends Resource
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
            'type' => optional($this->classType)->displayed_name,
            'schedule_id' => $this->id,
            'trainer' => $this->getTrainerName(),
            'start_time' => Carbon::parse($this->start_time)->format('H:i'),
            'end_time' => Carbon::parse($this->end_time)->format('H:i'),
            'lesson_time' => $this->getLessonTime(),
            'max_count_persons' => $this->max_count_persons,
            'count_persons' => $this->count_persons,
            'address' => null
        ];
    }

    private function getLessonTime()
    {
        $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->start_time);
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->end_time);

        return $start_time->diffInMinutes($end_time);
    }

    private function getTrainerName()
    {
        return optional($this->trainer)->trainer_name;
    }
}