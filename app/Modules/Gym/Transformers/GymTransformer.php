<?php

namespace App\Modules\Gym\Transformers;

use App\Modules\Gym\Entities\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use function PHPSTORM_META\map;

class GymTransformer extends Resource
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
            'gym_id' => $this->id,
            'address' => $this->address,
            'description' => $this->description,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'available_from' => $this->getAvailableFrom(),
            'available_to' => $this->getAvailableTo(),
            'trainers' => $this->includeTrainers(),
            'gym_name' => $this->getGymName()
        ];
    }

    private function getGymName()
    {
        return $this->name;
    }

    public function includeTrainers()
    {
        return $this->trainers->map(function ($trainer) {
            return [
                'trainer_name' => $trainer->trainer_name,
                'avg_rating' => $this->getAvgRating($trainer)
            ];
        });
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

    private function getAvailableFrom()
    {
        if($availableFrom = $this->available_from) {
            return Carbon::parse($availableFrom)->format('H:i');
        }
    }

    public function getAvailableTo()
    {
        if($availableTo = $this->available_to) {
            return Carbon::parse($availableTo)->format('H:i');
        }
    }
}
