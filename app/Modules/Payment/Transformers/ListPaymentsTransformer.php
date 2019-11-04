<?php

namespace App\Modules\Payment\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ListPaymentsTransformer extends Resource
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
            'description' => $this->description,
            'count_credits' => $this->count_credits,
            'price' => $this->price
        ];
    }
}
