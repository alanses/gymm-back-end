<?php

namespace App\Modules\Activities\Actions;

use App\Modules\Activities\Tasks\GetActivityTask;
use App\Modules\Admin\Http\Requests\ActivityRequest;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class GetActivityAction extends AbstractAction
{
    public function run(Request $request)
    {
        return $this->call(GetActivityTask::class, [], [
            ['findByField' => ['id', $request->id]]
        ]);
    }
}
