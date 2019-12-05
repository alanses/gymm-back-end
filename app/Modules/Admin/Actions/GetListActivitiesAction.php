<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Tasks\GetListActivitiesTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class GetListActivitiesAction extends AbstractAction
{
    public function run(Request $request)
    {
        return $this->call(GetListActivitiesTask::class, [], [
            ['search' => [$request->search]]
        ]);
    }
}
