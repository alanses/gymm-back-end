<?php

namespace App\Modules\SliderImages\Actions;

use App\Modules\SliderImages\Tasks\GetListImagesForSliderTask;
use App\Ship\Abstraction\AbstractAction;

class GetListImagesForSliderAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListImagesForSliderTask::class);
    }
}
