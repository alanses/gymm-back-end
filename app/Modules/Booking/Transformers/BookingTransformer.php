<?php

namespace App\Modules\Booking\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class BookingTransformer extends Resource
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
            'booking_id' => $this->id,
            'class' => $this->getClassName(),
            'date' => $this->getDate(),
            'time_start' => $this->getStartTime(),
            'time_end' => $this->getEndTime(),
            'address' => $this->getAddress(),
            'trainer_name' => $this->getTrainerName(),
            'credits' => $this->getCredits()
        ];
    }

    private function getClassName()
    {
        if($class_schedule = $this->classSchedule) {
            return optional($class_schedule->classType)->name;
        }
    }

    private function getDate()
    {
        return optional($this->classSchedule)->start_date;
    }

    private function getStartTime()
    {
        if($class_schedule = $this->classSchedule) {
            return Carbon::parse($this->start_time)->format('H:i');
        }
    }

    public function getEndTime()
    {
        if($class_schedule = $this->classSchedule) {
            return Carbon::parse($this->end_time)->format('H:i');
        }
    }

    public function getAddress()
    {
        if($class_schedule = $this->classSchedule) {
            return optional($class_schedule->gym)->address;
        }
    }

    public function getTrainerName()
    {
        if($class_schedule = $this->classSchedule) {
            return optional($class_schedule->trainer)->trainer_name;
        }
    }

    public function getCredits()
    {
        return optional($this->classSchedule)->credits;
    }
}
