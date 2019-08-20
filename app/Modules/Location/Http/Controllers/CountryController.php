<?php

namespace App\Modules\Location\Http\Controllers;

use App\Modules\Location\Actions\Countries\GetListCountriesAction;
use App\Modules\Location\Transformers\CountriesTransformer;
use App\Ship\Parents\ApiController;

class CountryController extends ApiController
{
    public function getAllCountries()
    {
        $countries = $this->call(GetListCountriesAction::class);

        return CountriesTransformer::collection($countries);
    }
}
