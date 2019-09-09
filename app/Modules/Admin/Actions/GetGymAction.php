<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Http\Requests\GymRequest;
use App\Modules\Gym\Tasks\FindGymTask;
use App\Ship\Abstraction\AbstractAction;

class GetGymAction extends AbstractAction
{
    public function run(GymRequest $request)
    {
        $gym = $this->call(FindGymTask::class, [], [
            ['getByField' => ['id', $request->id]],
            ['withRelations' => []]
        ]);

        return $gym;
    }
}
