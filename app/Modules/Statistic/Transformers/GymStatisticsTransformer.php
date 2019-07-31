<?php

namespace App\Modules\Statistic\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class GymStatisticsTransformer extends Resource
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
            'classes_count' => $this->count_trainers,
            'client_count' => null,
            'reviews' => null,
            'trainers' => null
        ];
    }
}
