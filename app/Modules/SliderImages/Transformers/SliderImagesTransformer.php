<?php

namespace App\Modules\SliderImages\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class SliderImagesTransformer extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        dd($this->resource);
        return parent::toArray($request);
    }
}
