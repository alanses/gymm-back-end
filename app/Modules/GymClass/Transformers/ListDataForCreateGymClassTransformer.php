<?php

namespace App\Modules\GymClass\Transformers;

use App\Ship\Parents\Resource;

class ListDataForCreateGymClassTransformer extends Resource
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
            'trainers' => [
                'id' => $this->trainers->id,
                'trainer_name' => $this->trainers->trainer_name
            ],
            'activities' => [
                'id' => $this->activities->id,
                'name' => $this->activities->name,
                'displayed_name' => $this->activities->displayed_name,
            ],
            'class_types' => [
                'id' => $this->class_types->id,
                'name' => $this->class_types->name,
                'displayed_name' => $this->class_types->displayed_name,
            ]
        ];
    }
}
