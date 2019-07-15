<?php

namespace App\Modules\Authentication\Actions;

use App\Modules\Authentication\Tasks\CheckIfOldPasswordValidTask;
use App\Modules\User\Tasks\ChangePasswordForUserTask;
use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;

class RestorePasswordAction extends AbstractAction
{
    public function run(string $oldPassword, string $newPassword, string $userId)
    {
        $user = $this->call(GetUserTask::class, [], [
            ['getByField' => ['id', $userId]]
        ]);

        $this->call(CheckIfOldPasswordValidTask::class, [$user, $oldPassword]);
        
        $this->call(ChangePasswordForUserTask::class, [$user, $newPassword]);
    }
}
