<?php

namespace App\Modules\Booking\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class BookingPreviewTransformer extends Resource
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
            'id' => $this->id,
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
        return optional($this->classType)->name;
    }

    private function getDate()
    {
        return $this->start_date;
    }

    private function getStartTime()
    {
        if ($this->start_time) {
            return Carbon::parse($this->start_time)->format('H:i');
        }
    }

    private function getEndTime()
    {
        if ($this->end_time) {
            return Carbon::parse($this->end_time)->format('H:i');
        }
    }

    private function getAddress()
    {
        return optional($this->gym)->address;
    }

    private function getTrainerName()
    {
        return optional($this->trainer)->trainer_name;
    }

    private function getCredits()
    {
        return $this->credits;
    }
}
