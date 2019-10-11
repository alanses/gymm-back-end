<?php

namespace App\Modules\UserProfile\Transformers;

use App\Modules\Booking\Entities\BookingClass;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class GetUserProfileTransformer extends Resource
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
            'user_id' => $this->id,
            'name' => $this->name,
            'available_credits' => $this->getCredits(),
            'total_credits_into_plan' => $this->getTotalCredits(),
            'payment_card' => null,
            'plan_name' => $this->getPlanName(),
            'reviews' => $this->getReviews(),
            'bookings' => $this->getBookings(),
        ];
    }

    private function getReviews()
    {
        if($this->classScheduleDescription) {
                return $this->classScheduleDescription->map(function ($scheduleDescription) {
                    return [
                        'reviews_id' => $scheduleDescription->id,
                        'description' => $scheduleDescription->description,
                        'rating_value' => $scheduleDescription->rating_value,
                        'name' => $this->getClassScheduleName($scheduleDescription)
                ];
                });
        }

        return [];
    }

    private function getClassScheduleName($scheduleDescription)
    {
        if($classSchedule = $scheduleDescription->classSchedule) {
            if($activityType = $classSchedule->activityType){
               return $activityType->displayed_name;
            }
        }
    }
    protected function getBookings()
    {
        return $this->bookings->map(function ($booking) {
            return [
                'start_time' => $this->convertStartTime($booking),
                'end_time' => $this->convertEndTime($booking),
                'lesson_time' => $this->getLessonTime($booking),
                'activity_type' => $this->getActivityType($booking),
                'address' => $this->getAddress($booking),
                'trainer' => $this->getTrainerName($booking),
                'count_credits' => $this->getCountCredits($booking),
                'avg_rating' => $this->getAvgRating($booking)
            ];
        });
    }

    private function getCountCredits(BookingClass $booking)
    {
        return optional($booking->classSchedule)->credits;
    }

    private function getTrainerName(BookingClass $booking)
    {
        if($classSchedule = $booking->classSchedule) {
            return optional($classSchedule->trainer)->trainer_name;
        }
    }

    private function getAddress(BookingClass $booking)
    {
        if($classSchedule = $booking->classSchedule) {
            return optional($classSchedule->gym)->address;
        }
    }

    private function getActivityType(BookingClass $booking)
    {
        if($classSchedule = $booking->classSchedule) {
            return optional($classSchedule->activityType)->displayed_name;
        }
    }

    private function convertStartTime(BookingClass $booking)
    {
        $start_time = optional($booking->classSchedule)->start_time;

        if($start_time) {
            return Carbon::parse($start_time)->format('H:i');
        }
    }

    private function convertEndTime(BookingClass $booking)
    {
        $end_time = optional($booking->classSchedule)->end_time;

        if($end_time) {
            return Carbon::parse($end_time)->format('H:i');
        }
    }

    private function getLessonTime(BookingClass $booking)
    {
        $start_time = optional($booking->classSchedule)->start_time;
        $end_time = optional($booking->classSchedule)->end_time;

        if($start_time && $end_time) {
            $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $start_time);
            $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $end_time);

            return $start_time->diffInMinutes($end_time);
        }
    }

    private function getAvgRating(BookingClass $bookingClass)
    {
        if ($classSchedule = $bookingClass->classSchedule) {
            if($trainer = $classSchedule->trainer) {
                $avg = $trainer->avgRating;
                if ($avg->isNotEmpty()) {
                    return $avg
                        ->first()
                        ->aggregate;
                }
            }

            return 0;
        }
    }

    private function getPlanName()
    {
        if($userDetail = $this->userDetail) {
            return optional($userDetail->plan)->name;
        }
    }

    private function getTotalCredits()
    {
        if($userDetail = $this->userDetail) {
           return optional($userDetail->plan)->count_credits;
        }
    }

    private function getCredits()
    {
        $transactions = $this->userTransactions;

        if($transactions->isEmpty()) {
            return 0;
        }

        return $transactions
            ->last()
            ->total;
    }
}
