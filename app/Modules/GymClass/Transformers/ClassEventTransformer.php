<?php

namespace App\Modules\GymClass\Transformers;

use App\Modules\Photos\Entities\Photo;
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
                'description' => $review->description,
                'user_name' => $this->getUserName($review),
                'address' => $this->getUserAddress($review),
                'rating_value' => $review->rating_value,
                'created_at' => $review->created_at
            ];
        });
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
