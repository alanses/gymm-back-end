<?php

namespace App\Modules\GymClass\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ClassSchedulesWithUserFilterTransformer extends Resource
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
            'credits' => $this->credits,
            'name' => $this->getActivity(),
            'distance' => 1,
            'trainer' => $this->getTrainerName(),
            'avg_rating' => $this->getAvgRating(),
            'description' => $this->description
        ];
    }

    private function getActivity()
    {
        return optional($this->activityType)
            ->displayed_name;
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
