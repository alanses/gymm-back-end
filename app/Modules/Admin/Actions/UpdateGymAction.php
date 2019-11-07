<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Http\Requests\UpdateGymRequest;
use App\Modules\Admin\Tasks\UpdateUserUsingGymTask;
use App\Modules\Gym\Tasks\UpdateGymTask;
use App\Modules\User\Tasks\UpdateUserTask;
use App\Ship\Abstraction\AbstractAction;
use Carbon\Carbon;

class UpdateGymAction extends AbstractAction
{
    public function run(UpdateGymRequest $request)
    {
        $gym = $this->call(UpdateGymTask::class, [$this->getDataForUpdateGym($request), $request->id]);

        $this->call(UpdateUserUsingGymTask::class, [$this->getDataForUpdateUser($request), $gym]);

        return $gym;
    }

    private function getDataForUpdateUser(UpdateGymRequest $request)
    {
        return $request->only(['email', 'name']);
    }

    private function getDataForUpdateGym(UpdateGymRequest $request)
    {
        return [
            'address' => $request->address,
            'description' => $request->description,
            'available_from' => Carbon::createFromFormat('H:i', $request->available_from)->format('Y-m-d H:i:s'),
            'available_to' => Carbon::createFromFormat('H:i', $request->available_to)->format('Y-m-d H:i:s'),
        ];
    }
}
