<?php

namespace App\Modules\Gym\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class TrainersForSelectTransformer extends Resource
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
            'id' => $this->id,
            'trainer_name' => $this->trainer_name,
        ];
    }
}
