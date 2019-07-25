<?php

namespace App\Modules\Gym\Transformers;

use Illuminate\Http\Resources\Json\Resource;

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
            'displayed_name' => $this->trainer_name,
            'level' => $this->level,
            'cretits_from' => $this->cretits_from,
            'cretits_to' => $this->cretits_to,
            'activities' => $this->includeActivities(),
        ];
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
