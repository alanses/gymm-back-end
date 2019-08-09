<?php

namespace App\Modules\GymClass\Transformers;

use App\Modules\Gym\Entities\Trainer;
use Illuminate\Http\Resources\Json\Resource;

class ListClassesTransformer extends Resource
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
            'activity_type' => $this->getActivityType(),
            'description' => $this->getGymDescription(),
            'trainer_name' => $this->getTrainerName(),
            'avg_rating' => $this->getAvgRating($this->trainer),
            'credits' => $this->credits
        ];
    }

    private function getActivityType()
    {
        if($this->activityType) {
            return optional($this->activityType)->displayed_name;
        }
    }

    private function getGymDescription()
    {
        return optional($this->gym)->description;
    }

    private function getTrainerName()
    {
        return optional($this->trainer)->trainer_name;
    }

    private function getAvgRating(Trainer $trainer)
    {
        $avg = $trainer->avgRating;

        if($avg->isNotEmpty()) {
            return $avg
                ->first()
                ->aggregate;
        }

        return 0;
    }
}
