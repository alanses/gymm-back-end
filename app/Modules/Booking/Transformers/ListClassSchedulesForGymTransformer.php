<?php

namespace App\Modules\Booking\Transformers;

use App\Modules\Booking\Entities\BookingClass;
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
            'address' => $this->getAddress(),
            'class_type' => $this->getClassType(),
            'gym_name' => $this->getGymName(),
            'users_booked' => $this->getBookedUser()
        ];
    }

    private function getBookedUser()
    {
        if($bookingUsers = $this->bookingUsers) {
            return $bookingUsers->map(function (BookingClass $booking) {
                return [
                    'name' => optional($booking->user)->name,
                    'email' => optional($booking->user)->email,
                    'photo' => $this->getUserPhoto($booking)
                ];
            });
        }

    }

    private function getUserPhoto(BookingClass $booking)
    {
        return optional($booking->user)->email;
    }

    private function getGymName()
    {
        return optional($this->gym)->name;
    }

    private function getClassType()
    {
        return optional($this->activityType)->displayed_name;
    }

    private function getAddress()
    {
        return optional($this->gym)->address;
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
