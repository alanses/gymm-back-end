<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Tasks\GetListReviewsTask;
use App\Ship\Abstraction\AbstractAction;

class GetListReviewsAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListReviewsTask::class);
    }
}
