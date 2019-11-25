<?php

namespace App\Modules\Location\Actions;

use App\Modules\Location\Http\Requests\CityRequest;
use App\Modules\Location\Tasks\CreateCityTask;
use App\Ship\Abstraction\AbstractAction;

class CreateCityAction extends AbstractAction
{
    public function run(CityRequest $request)
    {
        return $this->call(CreateCityTask::class, [$this->getDateForCreateCity($request)]);
    }

    private function getDateForCreateCity(CityRequest $request)
    {
        return $request->only(['displayed_name', 'name']);
    }
}
