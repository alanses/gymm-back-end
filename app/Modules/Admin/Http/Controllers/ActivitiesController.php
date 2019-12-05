<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Activities\Actions\DeleteActivityAction;
use App\Modules\Activities\Actions\GetActivityAction;
use App\Modules\Activities\Actions\UpdateActivityAction;
use App\Modules\Admin\Actions\CreateActivityAction;
use App\Modules\Admin\Actions\GetListActivitiesAction;
use App\Modules\Admin\Http\Requests\ActivityRequest;
use App\Modules\Admin\Transformers\ListActivitiesTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;

class ActivitiesController extends ApiController
{
    public function getListActivities(Request $request)
    {
        $activities = $this->call(GetListActivitiesAction::class, [$request]);

        return ListActivitiesTransformer::collection($activities);
    }

    public function getActivity(Request $request)
    {
        $activity = $this->call(GetActivityAction::class, [$request]);

        return new ListActivitiesTransformer($activity);
    }

    public function store(ActivityRequest $request)
    {
        $activity = $this->call(CreateActivityAction::class, [$request]);

        return new ListActivitiesTransformer($activity);
    }

    public function updateActivity(ActivityRequest $request)
    {
        $activity = $this->call(UpdateActivityAction::class, [$request]);

        return new ListActivitiesTransformer($activity);
    }

    public function deleteActivity($id)
    {
        $this->call(DeleteActivityAction::class, [$id]);

        return $this->success();
    }
}
