<?php

namespace App\Modules\Activities\Actions;

use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class AddActivitiesToUserAction extends AbstractAction
{
    public function run(Request $request)
    {
        $user = $this->call(GetUserTask::class, [], [
            'getByField' => ['id', $request->user_id]
        ]);

    }
}
