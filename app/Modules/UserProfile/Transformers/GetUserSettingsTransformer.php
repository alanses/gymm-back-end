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
            'city_id' => optional($this->userSetting)->city_id,
            'spots' => optional($this->userSetting)->spots,
            'level' => optional($this->userSetting)->level,
            'distance' => optional($this->userSetting)->distance,
            'cretits_from' => optional($this->userSetting)->cretits_from,
            'cretits_to' => optional($this->userSetting)->cretits_to,
            'activities' => $this->includeActivities(),
        ];
    }

    private function includeActivities()
    {
        if($this->activities) {
            return $this->activities->map(function ($activity) {
                return [
                    'id' => $activity->id,
                    'name' => $activity->name,
                    'displayed_name' => $activity->displayed_name,
                ];
            });
        }
    }
}
