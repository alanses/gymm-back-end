<?php

namespace App\Modules\Gym\Transformers;

use App\Ship\Parents\Resource;

class TrainersForProfileTransformer extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
