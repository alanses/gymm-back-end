<?php

namespace App\Modules\GymClass\Transformers;

use App\Modules\Gym\Entities\RatingForTrainer;
use App\Modules\GymClass\Entities\ClassScheduleDescription;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class ClassScheduleForGymTransformer extends Resource
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
            'class_name' => optional($this->activityType)->displayed_name,
            'trainer' => $this->getTrainerName(),
            'trainer_description' => null,
            'reviews' => $this->getReviews()
        ];
    }

    private function getReviews()
    {
        return $this->reviews->map(function ($review) {
            return [
                'reviews_id' => $review->id,
                'rating_value' => $review->rating_value,
                'when' => $this->convertDate($review),
                'who' => optional($review->user)->name,
                'city' => $this->getCity($review),
                'description' => $review->comment
            ];
        });

    }

    private function convertDate(RatingForTrainer $review)
    {
        return Carbon::parse($review->created_at)
            ->format('d.m h:i A');
    }

    private function getCity(RatingForTrainer $review)
    {
        if ($user = $review->user) {
            if ($userSetting = $user->userSetting) {
                if ($city = $userSetting->city) {
                    return $city->displayed_name;
                }
            }
        }
    }

    private function getTrainerName()
    {
        return optional($this->trainer)->trainer_name;
    }
}
