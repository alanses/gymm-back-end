<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Actions\GetLocationAction;
use App\Modules\Admin\Http\Requests\LocationRequest;
use App\Ship\Parents\ApiController;

class LocationController extends ApiController
{
    public function getLocation(LocationRequest $request)
    {
        return $this->call(GetLocationAction::class, [$request]);
    }
}
