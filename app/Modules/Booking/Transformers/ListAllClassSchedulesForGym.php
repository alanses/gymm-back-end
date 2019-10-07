<?php

namespace App\Modules\Booking\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ListAllClassSchedulesForGym extends Resource
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
            'schedule_id' => $this->id,
            'name' => $this->getActivityType(),
            'credits' => $this->credits,
            'trainer' => $this->getTrainerName(),
            'avg_rating' => $this->getAvgRating(),
        ];
    }

    private function getTrainerName()
    {
        return optional($this->trainer)->trainer_name;
    }

    private function getActivityType()
    {
        return optional($this->activityType)->displayed_name;
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
