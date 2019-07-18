<?php

namespace App\Modules\Plans\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class GetListPlansTransformer extends Resource
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
            'plan_id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'count_credits' => $this->count_credits,
            'payment_for_month' => $this->payment_for_month,
            'count_class' =>  '5-6' //Temp solusion
        ];
    }
}
