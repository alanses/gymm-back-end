<?php

namespace App\Modules\SliderImages\Actions;

use App\Modules\SliderImages\Entities\ImageSlider;
use App\Modules\SliderImages\Http\Requests\UpdateImageSliderRequest;
use App\Modules\SliderImages\Tasks\DeleteSliderImageTask;
use App\Modules\SliderImages\Tasks\GetSliderImageTask;
use App\Modules\SliderImages\Tasks\SavePhotoIntoStorageTask;
use App\Modules\SliderImages\Tasks\UpdatePhotoForSliderTask;
use App\Ship\Abstraction\AbstractAction;

class UpdatePhotoForSliderAction extends AbstractAction
{
    private $savedImage;

    public function __construct()
    {
        $this->savedImage = null;
    }

    public function run(UpdateImageSliderRequest $request)
    {
        $sliderImage = $this->call(GetSliderImageTask::class, [], [
            ['findByRelation' => ['id', $request->id]]
        ]);

        if($request->image) {
            $this->call(DeleteSliderImageTask::class, [$sliderImage]);
            $this->savedImage = $this->call(SavePhotoIntoStorageTask::class, [$request->image, ImageSlider::$PATH_TO_IMAGE]);
        }

        $this->updatePhotoForSlider($sliderImage, $this->getDateForUpdatePhotoSlider($request));

        return $sliderImage;
    }

    private function updatePhotoForSlider(ImageSlider $imageSlider, array $data)
    {
        return $imageSlider->update($data);
    }

    private function getDateForUpdatePhotoSlider(UpdateImageSliderRequest $request)
    {
        $data = $request->only('description');

        if($image = $this->savedImage) {
            $data['origin_image'] = $this->savedImage['origin_name'];
            $data['image'] = $this->savedImage['file_name'];
        }

        return $data;
    }
}
