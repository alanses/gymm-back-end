<?php

namespace App\Modules\Activities\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ListActivitiesForSelectTrasformer extends Resource
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
            'displayed_name' => $this->getDisplayedName(),
        ];
    }

    private function getDisplayedName()
    {
        return $this->getTranslation('displayed_name', 'en');
    }
}
