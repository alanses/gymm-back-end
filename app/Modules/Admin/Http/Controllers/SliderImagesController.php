<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\SliderImages\Actions\SaveSliderImagesAction;
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

    public function updateImage(Request $request, $id)
    {

    }
}
