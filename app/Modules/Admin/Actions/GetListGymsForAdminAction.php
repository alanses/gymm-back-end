<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Tasks\GetListGymsForAdminTask;
use App\Ship\Abstraction\AbstractAction;

class GetListGymsForAdminAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListGymsForAdminTask::class, [], [
            ['withRelation' => []]
        ]);
    }
}
