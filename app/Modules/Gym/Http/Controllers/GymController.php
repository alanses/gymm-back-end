<?php

namespace App\Modules\Gym\Http\Controllers;


use App\Modules\Gym\Actions\GetGymAction;
use App\Modules\Gym\Actions\GetListGymsAction;
use App\Modules\Gym\Http\Requests\GetGymRequest;
use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\Gym\Transformers\GymTransformer;
use App\Modules\Gym\Transformers\ListGymsTransformer;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Parents\ApiController;

class GymController extends ApiController
{
    public function getListGyms()
    {
        $gyms = $this->call(GetListGymsAction::class);

        return ListGymsTransformer::collection($gyms);
    }

    public function getGym(GetGymRequest $request)
    {
        $gym = $this->call(GetGymAction::class, [$request]);

        return new GymTransformer($gym);
    }

    public function getGymInfo()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);
        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        return new GymTransformer($gym);
    }
}
