<?php

namespace App\Modules\Gym\Tasks\Trainers;

use App\Modules\Gym\Entities\Trainer;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Support\Collection;

class ConvertTrainersFieldsTask extends AbstractTask
{
    public function run(Collection $trainers)
    {
        return $trainers->map(function ($trainer) {
            return [
                'id' => $trainer->id,
                'trainer_name' => $trainer->trainer_name,
                'avg_rating' => $this->getAvgRating($trainer),
                'count_ratings' => $this->getRatingDetails($trainer),
                'image' => $this->getImage($trainer)
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

    private function getRatingDetails(Trainer $trainer)
    {
        $avg = $trainer->avgRating;

        if($avg->isNotEmpty()) {
            return $avg
                ->first()
                ->count;
        }

        return 0;
    }

    private function getImage(Trainer $trainer)
    {
        return null;
    }
}
