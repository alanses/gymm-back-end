<?php

namespace App\Modules\GymClass\Transformers;

use App\Modules\GymClass\Entities\ClassScheduleDescription;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class ClassScheduleForGymTransformer extends Resource
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
            'class_name' => optional($this->activityType)->displayed_name,
            'trainer' => $this->getTrainerName(),
            'trainer_description' => null,
            'reviews' => $this->getReviews()
        ];
    }

    private function getReviews()
    {
        return $this->classScheduleDescription->map(function ($classScheduleDescription) {
            return [
                'reviews_id' => $classScheduleDescription->id,
                'rating_value' => $classScheduleDescription->rating_value,
                'when' => $this->convertDate($classScheduleDescription),
                'who' => optional($classScheduleDescription->user)->name,
                'city' => $this->getCity($classScheduleDescription),
                'description' => $classScheduleDescription->description
            ];
        });
    }

    private function convertDate(ClassScheduleDescription $classScheduleDescription)
    {
        return Carbon::parse($classScheduleDescription->created_at)
            ->format('d.m h:i A');
    }

    private function getCity(ClassScheduleDescription $classScheduleDescription)
    {
        if($user = $classScheduleDescription->user) {
            if($userSetting = $user->userSetting) {
                if($city = $userSetting->city) {
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
