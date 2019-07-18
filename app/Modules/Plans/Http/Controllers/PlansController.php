<?php

namespace App\Modules\Plans\Http\Controllers;

use App\Modules\Plans\Actions\GetListPlansAction;
use App\Modules\Plans\Transformers\GetListPlansTransformer;
use App\Ship\Parents\ApiController;

class PlansController extends ApiController
{
    public function getListPlans()
    {
        $listPlans = $this->call(GetListPlansAction::class, []);

        return GetListPlansTransformer::collection($listPlans);
    }
}
