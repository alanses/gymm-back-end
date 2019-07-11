<?php

namespace App\Modules\Activities\Http\Controllers;

use App\Modules\Activities\Actions\AddActivitiesToUserAction;
use App\Modules\Activities\Actions\GetAllActivitiesAction;
use App\Modules\Activities\Transformers\ActivitiesTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;

class ActivitiesController extends ApiController
{
    public function getAllActivities()
    {
        $activities = $this->call(GetAllActivitiesAction::class);

        return ActivitiesTransformer::collection($activities);
    }

    public function addActivitiesToUser(Request $request)
    {
        $this->call(AddActivitiesToUserAction::class, [$request]);

        return $this->success('ok');
    }
}
