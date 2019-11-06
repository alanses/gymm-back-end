<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Tasks\GetListGymsForAdminTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class GetListGymsForAdminAction extends AbstractAction
{
    public function run(Request $request)
    {
        return $this->call(GetListGymsForAdminTask::class, [], [
            ['search' => [$request->search]],
            ['withRelation' => []]
        ]);
    }
}
