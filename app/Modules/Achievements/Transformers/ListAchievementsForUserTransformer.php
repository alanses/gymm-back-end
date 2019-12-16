<?php

namespace App\Modules\Achievements\Transformers;

use App\Modules\Achievements\Entities\Achievement;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class ListAchievementsForUserTransformer extends Resource
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
            'achievements' => $this->getAchievements()
        ];
    }

    private function getAchievements()
    {
        return $this->resource['achievements']->map(function ($achievement) {
            return [
                'id' => $achievement->id,
                'displayed_name' => $achievement->displayed_name,
                'count_classes' => $achievement->count_classes,
                'activity_id' => $achievement->activity_id,
                'image' => $this->getImage($achievement),
                'visited_by_user' => $this->getVisitedByUser($achievement)
            ];
        });
    }

    private function getVisitedByUser(Achievement $achievement) {
        if($userPassedBookings = $this->resource['user']->userPassedBookings) {
            $countVisit = 0;
            foreach ($userPassedBookings as $userPassedBooking) {
                if($classSchedule = $userPassedBooking->classSchedule) {
                    if($achievement->activity_id == $classSchedule->activities_id) {
                        $countVisit++;
                    }
                }
            }
        }

        return $countVisit;
    }

    private function getImage(Achievement $achievement)
    {
        if($image = $achievement->image) {
            return env('APP_URL') . Storage::url($image);
        }
    }
}
