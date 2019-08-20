<?php

namespace App\Modules\GymClass\Transformers;

use App\Modules\GymClass\Entities\ClassScheduleDescription;
use Illuminate\Http\Resources\Json\Resource;

class ClassScheduleForUserTransformer extends Resource
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
            'address' => $this->getAddress(),
            'lat' => $this->getLat(),
            'lng' => $this->getLng(),
            'about_studio' => $this->getStudioInfo(),
            'activities' => $this->getActivities(),
            'count_credits' => $this->getCountCredits(),
            'reviews' => $this->getReviews()
        ];
    }

    private function getReviews()
    {
        return $this->classScheduleDescription->map(function ($element) {
            return [
                'when' => $element->created_at,
                'user_name' => optional($element->user)->name,
                'description' => $element->description,
                'city_name' => $this->getCityName($element),
                'rating' => $this->getRating($element)
            ];
        });
    }

    private function getRating(ClassScheduleDescription $classScheduleDescription)
    {
        return $classScheduleDescription->rating_value;
    }

    private function getCityName(ClassScheduleDescription $classScheduleDescription)
    {
        if($user = $classScheduleDescription->user) {
            if($userSetting = $user->userSetting) {
                return optional($userSetting->city)->displayed_name;
            }
        }
    }

    private function getCountCredits()
    {
        return $this->credits;
    }

    private function getActivities()
    {
        return optional($this->activityType)->displayed_name;
    }

    private function getStudioInfo()
    {
        return optional($this->gym)->description;
    }

    private function getLat()
    {
        return optional($this->gym)->lat;
    }

    private function getLng()
    {
        return optional($this->gym)->lng;
    }

    private function getAddress()
    {
        return optional($this->gym)->address;
    }
}
