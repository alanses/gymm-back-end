<?php

namespace App\Modules\Booking\Transformers;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class ListClassSchedulesForUserTransformer extends Resource
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
            'gym_name' => $this->getGymName(),
            'trainer' => $this->getTrainerName(),
            'start_time' => Carbon::parse($this->start_time)->format('H:i'),
            'end_time' => Carbon::parse($this->end_time)->format('H:i'),
            'lesson_time' => $this->getLessonTime(),
            'avg_rating' => $this->getAvgRating(),
            'credits' => $this->credits,
            'address' => $this->getAddress(),
            'is_booked' => $this->checkIfIsBooking()
        ];
    }

    private function checkIfIsBooking()
    {
        return $this->userBookings ? true : false;
    }

    private function getAddress()
    {
        return optional($this->gym)->address;
    }

    private function getGymName()
    {
        return optional($this->gym)->name;
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

    private function getAvgRating()
    {
        if ($trainer = $this->trainer) {
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
