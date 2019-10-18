<?php

namespace App\Modules\Booking\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class RateOfClassTransformer extends Resource
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
            'user_id' => $this->user_id,
            'class_schedule_id' => $this->class_schedule_id
        ];
    }
}
