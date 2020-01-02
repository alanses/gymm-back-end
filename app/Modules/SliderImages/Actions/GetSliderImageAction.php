<?php

namespace App\Modules\SliderImages\Actions;

use App\Modules\SliderImages\Tasks\GetSliderImageTask;
use App\Ship\Abstraction\AbstractAction;

class GetSliderImageAction extends AbstractAction
{
    public function run($id)
    {
        return $this->call(GetSliderImageTask::class, [], [
            ['findByRelation' => ['id', $id]]
        ]);
    }
}
