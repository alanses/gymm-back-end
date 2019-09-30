<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Http\Requests\LocationRequest;
use App\Modules\Admin\Tasks\GetLocationTask;
use App\Ship\Abstraction\AbstractAction;

class GetLocationAction extends AbstractAction
{
    public function run(LocationRequest $request)
    {
        return $this->call(GetLocationTask::class, [$request->address]);
    }
}
