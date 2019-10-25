<?php

namespace App\Modules\Languages\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class LanguagesTransformer extends Resource
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
            'short_name' => $this->short_name,
            'disabled_name' => $this->disabled_name,
        ];
    }
}
