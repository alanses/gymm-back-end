<?php

namespace App\Modules\Booking\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class PassedScheduleTransformer extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource ? $this->event_id : null
        ];
    }
}
