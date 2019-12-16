<?php

namespace App\Modules\Activities\Transformers;

use App\Ship\Parents\Resource;
use Illuminate\Support\Facades\Storage;

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
            'displayed_name' => $this->getDisplayedName($request),
            'image' => $this->getImage()
        ];
    }

    private function getDisplayedName($request)
    {
        if($shortName = $request->user()->language->short_name) {
            if($this->hasTranslation('displayed_name', $shortName)) {
                return $this->getTranslation('displayed_name', $shortName);
            }
        }
    }

    private function getImage()
    {
        if($image = $this->image) {
            return env('APP_URL') . Storage::url($image);
        }
    }
}
