<?php

namespace App\Modules\UserProfile\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class GetUserSettingsTransformer extends Resource
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
            'user_id' => $this->id,
            'city_id' => $this->userSetting->city_id,
            'spots' => $this->userSetting->spots,
            'level' => $this->userSetting->level,
            'distance' => $this->userSetting->distance,
            'cretits_from' => $this->userSetting->cretits_from,
            'cretits_to' => $this->userSetting->cretits_to,
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
