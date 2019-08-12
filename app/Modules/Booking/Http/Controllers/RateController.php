<?php

namespace App\Modules\Booking\Http\Controllers;

use App\Modules\Booking\Actions\GetDataForCreateRoteToClassAction;
use App\Modules\Booking\Actions\SaveRateToClassAction;
use App\Modules\Booking\Http\Requests\SaveRateToClassRequest;
use App\Modules\Booking\Transformers\RateToClassTransformer;
use App\Ship\Parents\ApiController;

class RateController extends ApiController
{
    public function saveRateToClass(SaveRateToClassRequest $saveRateToClassRequest)
    {
        $rate = $this->call(SaveRateToClassAction::class, [$saveRateToClassRequest]);

        return new RateToClassTransformer($rate);
    }

    public function getDataForCreateRateToClass()
    {
       return $this->call(GetDataForCreateRoteToClassAction::class);
    }
}
