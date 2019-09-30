<?php

namespace App\Modules\Gym\Actions;

use App\Modules\Gym\Tasks\ChangeConfirmationGymTask;
use App\Modules\Gym\Tasks\FindGymTask;
use App\Ship\Abstraction\AbstractAction;
use App\Modules\Admin\Http\Requests\GymRequest;

class MakeConfirmGymAction extends AbstractAction
{
    public function run(GymRequest $request)
    {
        $gym = $this->call(FindGymTask::class, [], [
            ['getByField' => ['id', $request->id]]
        ]);

        $this->call(ChangeConfirmationGymTask::class, [$gym, $request]);
    }
}
