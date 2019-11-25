<?php

namespace App\Modules\Location\Actions;

use App\Modules\Location\Http\Requests\CityRequest;
use App\Modules\Location\Repositories\CitiesRepository;
use App\Modules\Location\Tasks\UpdateCityTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class UpdateCityAction extends AbstractAction
{
    public function run(Request $request)
    {
        return $this->call(UpdateCityTask::class, [
            $this->getDateForUpdateCity($request),
            $request->id
        ]);
    }

    private function getDateForUpdateCity(Request $request)
    {
        return $request->only(['displayed_name', 'name']);
    }
}
