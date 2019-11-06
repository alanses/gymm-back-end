<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Tasks\GetListReviewsTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class GetListReviewsAction extends AbstractAction
{
    public function run(Request $request)
    {
        return $this->call(GetListReviewsTask::class, [$request], [
            ['search' => [$request->search]]
        ]);
    }
}
