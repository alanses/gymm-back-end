<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class GetUserByIdAction extends AbstractAction
{
    /**
     * @param  Request  $request
     * @return User
     */
    public function run($user_id)
    {
        /** @var User $user */
        $user = $this->call(GetAllUsersTask::class, [], [
            ['getByField' => ['id', $user_id]]
        ])
        ->first();

        return $user;
    }
}
