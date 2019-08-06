<?php

namespace App\Modules\Gym\Transformers;

use App\Modules\Photos\Entities\TrainerPhoto;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class TrainerTransformer extends Resource
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
            'trainer_id' => $this->id,
            'trainer_name' => $this->trainer_name,
            'level' => $this->level,
            'cretits_from' => $this->cretits_from,
            'cretits_to' => $this->cretits_to,
            'activities' => $this->includeActivities(),
            'photo' => $this->getPhoto()
        ];
    }

    private function getPhoto()
    {
        if($photo = $this->photo) {
            return env('APP_URL') . Storage::url(TrainerPhoto::getBasePathForTrainerPhotos() .  $photo->file_name);
        }
    }

    public function includeActivities()
    {
        return $this->activities->map(function ($activity) {
            return [
                'id' => $activity->id,
                'name' => $activity->name,
                'displayed_name' => $activity->displayed_name,
            ];
        });
    }
}
