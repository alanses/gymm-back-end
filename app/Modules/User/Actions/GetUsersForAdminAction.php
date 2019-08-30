<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Ship\Abstraction\AbstractAction;

class GetUsersForAdminAction extends AbstractAction
{
    public function run()
    {
        $users = $this->call(GetAllUsersTask::class, [], [
            ['whereTypeIn' => ['user_type', [User::$is_user, User::$is_gym]]],
            ['withRelation' => []]
        ]);

        return $users;
    }
}
