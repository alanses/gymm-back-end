<?php

namespace App\Modules\GymClass\Transformers;

use App\Modules\Gym\Entities\RatingForTrainer;
use App\Modules\Photos\Entities\Photo;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class ClassEventTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'trainer_name' => $this->getTrainerName(),
            'name' => $this->getName(),
            'reviews' => $this->getReviews(),
            'photo' => $this->getPhoto()
        ];
    }

    private function getName()
    {
        return optional($this->activityType)->displayed_name;
    }

    private function getPhoto()
    {
        if($this->file_name) {
            return env('APP_URL') . Storage::url(Photo::getBasePathForSchedule() .  $this->file_name);
        }
    }

    private function getTrainerName()
    {
        if($trainer = $this->trainer) {
           return $trainer->trainer_name;
        }
    }

    private function getReviews()
    {
        return $this->reviews->map(function ($review) {
            return [
                'id' => $review->id,
                'description' => $review->comment,
                'user_name' => $this->getUserName($review),
                'address' => $this->getUserAddress($review),
                'rating_value' => $review->rating_value,
                'created_at' => $review->created_at,
                'when' => $this->getCreatingDate($review),
                'city_name' => $this->getCityName($review),
            ];
        });
    }

    private function getCityName(RatingForTrainer $classScheduleDescription)
    {
        if($user = $classScheduleDescription->user) {
            if($userSetting = $user->userSetting) {
                return optional($userSetting->city)->displayed_name;
            }
        }
    }

    private function getCreatingDate($review)
    {
        return Carbon::parse($review->created_at)->format('Y.m.d H:i');
    }


    private function getUserName($review)
    {
        if($user = $review->user) {
            return $user->name;
        }
    }

    private function getUserAddress($review)
    {
        if($user = $review->user) {
            return null;
        }
    }
}
