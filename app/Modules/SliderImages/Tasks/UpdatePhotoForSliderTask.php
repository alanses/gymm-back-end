<?php

namespace App\Modules\SliderImages\Tasks;

use App\Modules\SliderImages\Entities\ImageSlider;
use App\Ship\Abstraction\AbstractTask;

class UpdatePhotoForSliderTask extends AbstractTask
{
    public function run(ImageSlider $imageSlider, array $data)
    {
        return $imageSlider->update($data);
    }
}
