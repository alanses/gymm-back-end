<?php

namespace App\Modules\Languages\Http\Controllers;

use App\Modules\Languages\Actions\ChangeLanguageUserAction;
use App\Modules\Languages\Actions\GetListLanguagesAction;
use App\Modules\Languages\Http\Requests\LanguageRequest;
use App\Modules\Languages\Transformers\LanguagesTransformer;
use App\Modules\Languages\Transformers\UserLanguageTransformer;
use App\Ship\Parents\ApiController;

class LanguagesController extends ApiController
{
    public function getListLanguages()
    {
        $listLanguages = $this->call(GetListLanguagesAction::class);

        return LanguagesTransformer::collection($listLanguages);
    }

    public function setLanguageToUser(LanguageRequest $request)
    {
        $user = $this->call(ChangeLanguageUserAction::class, [$request]);

        return new UserLanguageTransformer($user);
    }
}
