<?php

namespace App\Modules\SliderImages\Transformers;

use App\Modules\SliderImages\Entities\ImageSlider;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

class ListImagesForSliderTransformer extends Resource
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
            'description' => $this->description,
            'origin_name' => $this->origin_image,
            'path' => $this->getPathToImage()
        ];
    }

    private function getPathToImage()
    {
        if($image = $this->image) {
            return env('APP_URL') . Storage::url(ImageSlider::$PATH_TO_IMAGE . '/' . $image);
        }
    }
}
