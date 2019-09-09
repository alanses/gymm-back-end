<?php

namespace App\Modules\Gym\Actions;

use App\Modules\Gym\Tasks\FindGymTask;
use App\Modules\Gym\Tasks\UpdateGymTask;
use App\Ship\Abstraction\AbstractAction;
use App\Modules\Admin\Http\Requests\GymRequest;

class MakeConfirmGymAction extends AbstractAction
{
    public function run(GymRequest $request)
    {
        $gym = $this->call(FindGymTask::class, [], [
            ['getByField' => ['id', $request->id]]
        ]);

        $this->call(UpdateGymTask::class, [$gym, $request]);
    }
}
