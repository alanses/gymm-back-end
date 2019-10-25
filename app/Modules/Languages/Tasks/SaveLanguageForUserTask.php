<?php

namespace App\Modules\Languages\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;

class SaveLanguageForUserTask extends AbstractTask
{
    public function run(User $user, ?int $LanguageId)
    {
        return $user->update([
            'language_id' => $LanguageId
        ]);
    }
}
