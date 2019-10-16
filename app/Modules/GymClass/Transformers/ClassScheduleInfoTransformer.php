<?php

namespace App\Modules\GymClass\Transformers;

use App\Modules\Gym\Entities\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class ClassScheduleInfoTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'trainer_name' => $this->getTrainerName(),
            'description' => $this->getDescription(),
            'avg_rating' => $this->getAvgRating(),
            'available_from' => $this->getGymAvailableFrom(),
            'available_to' => $this->getGymAvailableTo(),
            'lesson_time' => $this->getLessonTime(),
            'lat' => $this->getLat(),
            'lng' => $this->getLng(),
        ];
    }

    private function getLessonTime()
    {
        $start_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->start_time);
        $end_time = Carbon::createFromFormat('Y-m-d H:i:s', $this->end_time);

        return $start_time->diffInMinutes($end_time);
    }

    private function getLat()
    {
        return optional($this->gym)->lat;
    }

    private function getLng()
    {
        return optional($this->gym)->lng;
    }

    private function getTrainerName()
    {
        return optional($this->trainer)->trainer_name;
    }

    private function getDescription()
    {
        return $this->description;
    }

    private function getGymAvailableFrom()
    {
        if($start_time = $this->start_time) {
            return Carbon::parse($start_time)->format('H:i');
        }
    }

    private function getGymAvailableTo()
    {
        if($end_time = $this->end_time) {
            return Carbon::parse($end_time)->format('H:i');
        }
    }

    private function getAvgRating()
    {
        $trainer = $this->trainer;

        if($trainer) {
            $avg = $trainer->avgRating;

            if($avg->isNotEmpty()) {
                return $avg
                    ->first()
                    ->aggregate;
            }
        }

        return 0;
    }
}
