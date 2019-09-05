<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Http\Requests\GymRequest;
use App\Modules\Gym\Tasks\GetGymTask;
use App\Ship\Abstraction\AbstractAction;

class GetGymAction extends AbstractAction
{
    public function run(GymRequest $request)
    {
        $gym = $this->call(GetGymTask::class, [], [
            ['findByField' => ['user_id', $request->id]]
        ])
            ->first();

        return $gym->load('user');
    }
}
