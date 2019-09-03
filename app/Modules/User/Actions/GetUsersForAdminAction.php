<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class GetUsersForAdminAction extends AbstractAction
{
    public function run(Request $request)
    {
        $users = $this->call(GetAllUsersTask::class, [], [
            ['whereTypeIn' => ['user_type', [User::$is_user, User::$is_gym]]],
            ['search' => [$request]],
            ['withRelation' => []]
        ]);

        return $users;
    }
}
