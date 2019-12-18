<?php

namespace App\Modules\Location\Http\Controllers;

use App\Modules\Location\Actions\CreateCityAction;
use App\Modules\Location\Actions\DeleteCityAction;
use App\Modules\Location\Actions\GetCityAction;
use App\Modules\Location\Actions\GetListCitiesForAdminPageAction;
use App\Modules\Location\Actions\UpdateCityAction;
use App\Modules\Location\Http\Requests\CityRequest;
use App\Modules\Location\Http\Requests\UpdateCityRequest;
use App\Ship\Parents\ApiController;
use App\Modules\Location\Actions\Cities\GetListCitiesAction;
use App\Modules\Location\Transformers\CitiesTransformer;
use Illuminate\Http\Request;

class CityController extends ApiController
{
    public function getAllCityControllers()
    {
        $cities = $this->call(GetListCitiesAction::class);

        return CitiesTransformer::collection($cities);
    }

    public function getListCities(Request $request)
    {
        $cities = $this->call(GetListCitiesForAdminPageAction::class, [$request]);

        return CitiesTransformer::collection($cities);
    }

    public function createCity(CityRequest $request)
    {
        $city = $this->call(CreateCityAction::class, [$request]);

        return new CitiesTransformer($city);
    }

    public function updateCity(UpdateCityRequest $request)
    {
        $city = $this->call(UpdateCityAction::class, [$request]);

        return new CitiesTransformer($city);
    }

    public function getCity($id)
    {
        $city = $this->call(GetCityAction::class, [$id]);

        return new CitiesTransformer($city);
    }

    public function deleteCity($id)
    {
        $this->call(DeleteCityAction::class, [$id]);

        $this->success();
    }
}
