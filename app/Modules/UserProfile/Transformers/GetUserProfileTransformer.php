<?php

namespace App\Modules\UserProfile\Transformers;

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
            'reviews' => null,
            'bookings' => $this->getBookings()
        ];
    }

    private function getBookings()
    {
        return $this->bookings->map(function ($booking) {
            return [
                'start_time' => optional($booking->classSchedule)->start_time,
                'end_time' => optional($booking->classSchedule)->end_time,
            ];
        });
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
