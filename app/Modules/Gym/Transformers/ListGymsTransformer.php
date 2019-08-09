<?php

namespace App\Modules\Gym\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ListGymsTransformer extends Resource
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
            'gym_id' => $this->id,
            'address' => $this->address,
            'img' => null
        ];
    }
}
