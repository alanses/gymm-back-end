<?php

namespace App\Modules\Gym\Actions;

use App\Modules\Gym\Http\Requests\GetGymRequest;
use App\Modules\Gym\Tasks\GetGymTask;
use App\Ship\Abstraction\AbstractAction;

class GetGymAction extends AbstractAction
{
    public function run(GetGymRequest $request)
    {
        $gym = $this->call(GetGymTask::class, [], [
            ['findByField' => ['id', $request->id]]
        ])
            ->first();

        return $gym->load('trainers.avgRating');
    }
}
