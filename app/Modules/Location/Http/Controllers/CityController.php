<?php

namespace App\Modules\Location\Http\Controllers;

use App\Ship\Parents\ApiController;
use App\Modules\Location\Actions\Cities\GetListCitiesAction;
use App\Modules\Location\Transformers\CitiesTransformer;

class CityController extends ApiController
{
    public function getAllCityControllers()
    {
        $cities = $this->call(GetListCitiesAction::class);

        return CitiesTransformer::collection($cities);
    }

    public function getCityControllerById()
    {

    }

    public function createCityController()
    {

    }

    public function updateCityController()
    {

    }

    public function deleteCityController()
    {

    }
}
