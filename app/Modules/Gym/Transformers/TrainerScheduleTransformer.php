<?php

namespace App\Modules\Gym\Transformers;

use App\Modules\Booking\Entities\BookingClass;
use App\Modules\Gym\Entities\Trainer;
use App\Modules\Photos\Entities\TrainerPhoto;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class TrainerScheduleTransformer extends Resource
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
            'trainer_name' => $this->trainer_name,
            'photo' => $this->getPhoto(),
            'schedules' => $this->getSchedules(),
            'count_classes' => $this->getCountClasses(),
            'count_ratings' => $this->getRatingDetails(),
            'avg_rating' => $this->getAvgRating(),
        ];
    }

    private function getAvgRating()
    {
        $avg = $this->avgRating;

        if ($avg->isNotEmpty()) {
            return $avg
                ->first()
                ->aggregate;
        }

        return 0;
    }

    private function getSchedules()
    {
        return [
            'future' => $this->getFutureBooking(),
            'past' => $this->getPastBooking(),
        ];
    }

    private function getFutureBooking()
    {
        $data = collect();
        foreach ($this->bookings as $booking) {
            if($booking->classSchedule->start_date > Carbon::now()) {
                $data->push($this->getBookingDate($booking));
            }
        }

        return $data;
    }

    private function getPastBooking()
    {
        $data = collect();
        foreach ($this->bookings as $booking) {
            if($booking->classSchedule->start_date <= Carbon::now()) {
                $data->push($this->getBookingDate($booking));
            }
        }

        return $data;
    }

    private function getBookingDate($booking)
    {
        return [
            'booking_id' => $booking->id,
            'date' => optional($booking->classSchedule)->start_date,
            'activity' => $this->getActivity($booking),
            'credits' => optional($booking->classSchedule)->credits,
            'description' => optional($booking->classSchedule)->description
        ];
    }

    private function getActivity(BookingClass $bookingClass)
    {
        if ($classSchedule = $bookingClass->classSchedule) {
            return optional($classSchedule->activityType)->displayed_name;
        }
    }

    private function getRatingDetails()
    {
        $avg = $this->avgRating;

        if ($avg->isNotEmpty()) {
            return $avg->first()->count;
        }

        return 0;
    }

    private function getCountClasses()
    {
        return $this->class_schedules_count;
    }

    private function getPhoto()
    {
        if ($photo = $this->photo) {
            return env('APP_URL') . Storage::url(TrainerPhoto::getBasePathForTrainerPhotos() . $photo->file_name);
        }
    }
}
