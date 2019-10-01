<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Http\Requests\UpdateGymRequest;
use App\Modules\Gym\Tasks\UpdateGymTask;
use App\Modules\User\Tasks\UpdateUserTask;
use App\Ship\Abstraction\AbstractAction;

class UpdateGymAction extends AbstractAction
{
    public function run(UpdateGymRequest $request)
    {
        $gym = $this->call(UpdateGymTask::class, [$this->getDataForUpdateGym($request), $request->id]);

        dd($gym, '123');
    }

    private function getDataForUpdateUser(UpdateGymRequest $request)
    {
        return $request->only([
            ''
        ]);
    }

    private function getDataForUpdateGym(UpdateGymRequest $request)
    {
        return $request->only([
            'id',
            'email',
            'address',
            'description',
//            'available_from',
//            'available_to'
        ]);
    }
}
