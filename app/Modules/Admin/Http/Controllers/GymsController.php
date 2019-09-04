<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Actions\GetListGymsForAdminAction;
use App\Modules\Admin\Transformers\ListGymsTransformer;
use App\Ship\Parents\ApiController;

class GymsController extends ApiController
{
    public function getGyms()
    {
        $gyms = $this->call(GetListGymsForAdminAction::class);

        return ListGymsTransformer::collection($gyms);
    }

    public function getGym()
    {

    }

    public function confirmGym()
    {

    }
}
