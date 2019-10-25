<?php

namespace App\Modules\Languages\Actions;

use App\Modules\Languages\Http\Requests\LanguageRequest;
use App\Modules\Languages\Tasks\SaveLanguageForUserTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;

class ChangeLanguageUserAction extends AbstractAction
{
    public function run(LanguageRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $this->call(SaveLanguageForUserTask::class, [$user, $this->getNewLanguage($request)]);

        return $user;
    }

    private function getNewLanguage(LanguageRequest $request)
    {
        return $request->language_id;
    }
}
