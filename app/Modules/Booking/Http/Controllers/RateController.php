<?php

namespace App\Modules\Booking\Http\Controllers;

use App\Modules\Booking\Actions\GetDataForCreateRoteToClassAction;
use App\Modules\Booking\Actions\RegisterThatUserNotPassedClassAction;
use App\Modules\Booking\Actions\SaveRateDescriptionAction;
use App\Modules\Booking\Actions\SaveRateOfClassAction;
use App\Modules\Booking\Actions\SaveRateToClassAction;
use App\Modules\Booking\Http\Requests\RegisterUserNotPassClassRequest;
use App\Modules\Booking\Http\Requests\SaveRateOfClassRequest;
use App\Modules\Booking\Http\Requests\SaveRateToClassRequest;
use App\Modules\Booking\Transformers\RateOfClassTransformer;
use App\Modules\Booking\Transformers\RateToClassTransformer;
use App\Modules\GymClass\Http\Requests\SaveRateDescriptionOfClassRequest;
use App\Ship\Parents\ApiController;

class RateController extends ApiController
{
    public function saveRateToClass(SaveRateToClassRequest $saveRateToClassRequest) // deplicated
    {
        $rate = $this->call(SaveRateToClassAction::class, [$saveRateToClassRequest]);

        return new RateToClassTransformer($rate);
    }

    public function getDataForCreateRateToClass()
    {
       return $this->call(GetDataForCreateRoteToClassAction::class);
    }


    public function saveRateOfClass(SaveRateOfClassRequest $request)
    {
        $rate = $this->call(SaveRateOfClassAction::class, [$request]);

        return new RateOfClassTransformer($rate);
    }

    public function saveRateDescriptionOfClass(SaveRateDescriptionOfClassRequest $request)
    {
        $this->call(SaveRateDescriptionAction::class, [$request]);

        return $this->success();
    }

    public function registerUserNotPassClass(RegisterUserNotPassClassRequest $request)
    {
        $this->call(RegisterThatUserNotPassedClassAction::class, [$request]);

        $this->success();
    }
}
