<?php

namespace App\Modules\SliderImages\Tasks;

use App\Modules\Admin\Services\FileService;
use App\Modules\SliderImages\Entities\ImageSlider;
use App\Ship\Abstraction\AbstractTask;

class DeleteSliderImageTask extends AbstractTask
{
    /**
     * @var FileService
     */
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function run(ImageSlider $imageSlider)
    {
        return $this->fileService->deleteFile(ImageSlider::$PATH_TO_IMAGE . '/' . $imageSlider->image);
    }
}
