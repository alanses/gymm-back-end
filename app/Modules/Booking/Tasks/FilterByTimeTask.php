<?php

namespace App\Modules\Booking\Tasks;

use App\Ship\Abstraction\AbstractTask;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class FilterByTimeTask extends AbstractTask
{
    public function run(Collection $bookings)
    {
        $currentTime = Carbon::now()->format('H:i:s');
        $currentDate = Carbon::now()->format('Y-m-d');

        $filterBookings = $bookings->filter(function ($booking) use ($currentTime, $currentDate) {
            if($this->checkIfCurrentDateIsEqualStartDate($booking, $currentDate)) {
                $scheduleEndTime = Carbon::parse($booking->classSchedule->end_time)->format('H:i:s');
                if($this->checkIfCurrentTimeLessThenScheduleEndTime($currentTime, $scheduleEndTime)) {
                    return false;
                }
            }

            return true;
        });

        return $filterBookings->first();
    }

    private function checkIfCurrentDateIsEqualStartDate($booking, $currentDate)
    {
        if($booking->classSchedule->start_date == $currentDate) {
            return true;
        }
    }

    private function checkIfCurrentTimeLessThenScheduleEndTime($currentTime, $scheduleEndTime)
    {
        if($currentTime <= $scheduleEndTime) {
            return true;
        }
    }
}
