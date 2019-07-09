<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;

class FindUserByEmailAction extends AbstractAction
{
    /**
     * @param  string  $email
     * @return User
     */
    public function run(string $email)
    {
        /** @var User $user */

        $user = $this->call(GetUserTask::class, [], [
            ['getByField' => ['email', $email]]
        ]);

        return $user;
    }
}
