<?php

namespace App\Modules\SliderImages\Actions;

use App\Modules\SliderImages\Entities\ImageSlider;
use App\Modules\SliderImages\Tasks\SaveImageTask;
use App\Modules\SliderImages\Tasks\SavePhotoIntoStorageTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class SaveSliderImagesAction extends AbstractAction
{
    public function run(Request $request)
    {
        $imagesCollection = collect();

        foreach ($request->photos as $photo) {
            $savedImage = $this->call(SavePhotoIntoStorageTask::class, [$photo['photo'], ImageSlider::$PATH_TO_IMAGE]);
            $image = $this->call(SaveImageTask::class, [$this->getDataForCreateImage($savedImage, $photo)]);

            $imagesCollection->push($image);
        }

        return $imagesCollection;
    }

    private function getDataForCreateImage($savedImage, $photo) :array
    {
        return [
            'image' => $savedImage['file_name'],
            'origin_image' => $savedImage['origin_name'],
            'description' => $photo['description'],
        ];
    }
}
