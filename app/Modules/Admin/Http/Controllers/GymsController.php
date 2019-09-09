<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Actions\GetGymAction;
use App\Modules\Admin\Actions\GetListGymsForAdminAction;
use App\Modules\Admin\Actions\UpdateGymAction;
use App\Modules\Admin\Http\Requests\GymRequest;
use App\Modules\Admin\Http\Requests\UpdateGymRequest;
use App\Modules\Admin\Transformers\GymTransformer;
use App\Modules\Admin\Transformers\ListGymsTransformer;
use App\Modules\Gym\Actions\MakeConfirmGymAction;
use App\Ship\Parents\ApiController;

class GymsController extends ApiController
{
    public function getGyms()
    {
        $gyms = $this->call(GetListGymsForAdminAction::class);

        return ListGymsTransformer::collection($gyms);
    }

    public function getGym(GymRequest $request)
    {
        $gym = $this->call(GetGymAction::class, [$request]);

        return new GymTransformer($gym);
    }

    public function confirmGym(GymRequest $request)
    {
        $this->call(MakeConfirmGymAction::class, [$request]);

        $this->success();
    }

    public function updateGym(UpdateGymRequest $request)
    {
        $gym = $this->call(UpdateGymAction::class, [$request]);

        return new GymTransformer($gym);
    }
}
