<?php

namespace App\Modules\Gym\Http\Controllers;


use App\Modules\Gym\Actions\GetGymAction;
use App\Modules\Gym\Actions\GetListGymsAction;
use App\Modules\Gym\Http\Requests\GetGymRequest;
use App\Modules\Gym\Transformers\GymTransformer;
use App\Modules\Gym\Transformers\ListGymsTransformer;
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
}
