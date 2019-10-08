<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Tasks\GetListClientsTask;
use App\Ship\Abstraction\AbstractAction;

class GetListClientsAction extends AbstractAction
{
    public function run()
    {
        $users = $this->call(GetListClientsTask::class, [], [
            ['setSelectedFields' => [['id', 'name', 'email']]],
            ['whereTypeIsUser' => []]
        ]);

        return $users->load('userPhoto');
    }
}
