<?php

namespace App\Modules\Booking\Actions;

use App\Modules\Booking\Tasks\GetListFullClassOptionsTask;
use App\Ship\Abstraction\AbstractAction;

class GetDataForCreateRoteToClassAction extends AbstractAction
{
    public function run()
    {
        $data = [];

        $data['list_full_class_options'] = $this->call(GetListFullClassOptionsTask::class, [], [
            ['setSelectedFields' => [['id', 'name', 'displayed_name']]]
        ]);

        return $data;
    }
}
