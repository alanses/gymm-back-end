<?php

namespace App\Modules\Activities\Transformers;

use App\Ship\Parents\Resource;

class ActivitiesTransformer extends Resource
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
            'name' => $this->name,
            'displayed_name' => $this->displayed_name,
        ];
    }
}
