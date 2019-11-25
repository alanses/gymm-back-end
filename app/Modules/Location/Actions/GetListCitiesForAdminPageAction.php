<?php

namespace App\Modules\Location\Actions;

use App\Modules\Location\Tasks\GetCitiesTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class GetListCitiesForAdminPageAction extends AbstractAction
{
    public function run(Request $request)
    {
        return $this->call(GetCitiesTask::class, [], [
            ['search' => [$request->search]]
        ]);
    }
}
