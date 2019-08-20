<?php

namespace App\Modules\Gym\Tasks\Trainers;

use App\Modules\Gym\Entities\Trainer;
use App\Modules\Photos\Entities\TrainerPhoto;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

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
                'image' => $this->getImage($trainer),
                'count_classes' => $this->getCountClasses($trainer)
            ];
        });
    }

    private function getCountClasses(Trainer $trainer)
    {
        return $trainer->class_schedules_count;
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
        if($photo = $trainer->photo) {
            return env('APP_URL') . Storage::url(TrainerPhoto::getBasePathForTrainerPhotos() .  $photo->file_name);
        }
    }
}
