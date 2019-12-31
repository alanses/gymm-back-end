<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\SliderImages\Actions\GetListImagesForSliderAction;
use App\Modules\SliderImages\Actions\GetSliderImageAction;
use App\Modules\SliderImages\Actions\SaveSliderImagesAction;
use App\Modules\SliderImages\Actions\UpdatePhotoForSliderAction;
use App\Modules\SliderImages\Http\Requests\UpdateImageSliderRequest;
use App\Modules\SliderImages\Transformers\ListImagesForSliderTransformer;
use App\Modules\SliderImages\Transformers\SliderImagesTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;

class SliderImagesController extends ApiController
{
    public function saveImages(Request $request)
    {
        $images = $this->call(SaveSliderImagesAction::class, [$request]);

        return new SliderImagesTransformer($images);
    }

    public function listImagesForSlider()
    {
        $images = $this->call(GetListImagesForSliderAction::class);

        return ListImagesForSliderTransformer::collection($images);
    }

    public function getSliderImage($id)
    {
        $image = $this->call(GetSliderImageAction::class, [$id]);

        return new ListImagesForSliderTransformer($image);
    }

    public function updateImage(UpdateImageSliderRequest $request)
    {
        $image = $this->call(UpdatePhotoForSliderAction::class, [$request]);

        return new ListImagesForSliderTransformer($image);
    }
}
