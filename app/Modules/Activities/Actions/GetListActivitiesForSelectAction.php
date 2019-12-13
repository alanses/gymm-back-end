<?php

namespace App\Modules\Activities\Actions;

use App\Modules\Activities\Tasks\GetListActivitiesForSelectTask;
use App\Ship\Abstraction\AbstractAction;

class GetListActivitiesForSelectAction extends AbstractAction
{
    public function run()
    {
        return $this->call(GetListActivitiesForSelectTask::class, [], [
            ['setSelectedFields' => [['id', 'displayed_name']]]
        ]);
    }
}
