<?php

namespace App\Modules\SliderImages\Transformers;

use App\Modules\Photos\Entities\UserPhoto;
use App\Modules\SliderImages\Entities\ImageSlider;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Storage;

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
        return [
            'images' => $this->getImages()
        ];
    }

    public function getImages()
    {
        return $this->resource->map(function (ImageSlider $image) {
            return [
                'id' => $image->id,
                'description' => $image->description,
                'origin_name' => $image->origin_image,
                'path' => $this->getPathToImage($image)
            ];
        });
    }

    private function getPathToImage(ImageSlider $image)
    {
        return env('APP_URL') . Storage::url(ImageSlider::$PATH_TO_IMAGE . '/' . $image->image);
    }
}
