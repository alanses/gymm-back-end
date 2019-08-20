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
            'classes_count' => $this->resource['count_classes'],
            'count_clients' => $this->resource['count_clients'],
            'reviews' => $this->resource['count_reviews'],
            'trainers' => $this->resource['count_trainers']
        ];
    }
}
