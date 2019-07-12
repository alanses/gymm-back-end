<?php

namespace App\Modules\Authentication\Actions;

use App\Modules\Authentication\Tasks\GenerateNewPasswordTask;
use App\Modules\Authentication\Tasks\SendEmailToUserTask;
use App\Modules\User\Tasks\ChangePasswordForUserTask;
use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SendNewPasswordOnEmailAction extends AbstractAction
{
    /**
     * @param string $email
     */
    public function run(string $email)
    {
        $user = $this->checkIfUserExist($email);

        $newPassword = $this->call(GenerateNewPasswordTask::class);
        
        $this->call(ChangePasswordForUserTask::class, [$user, $newPassword]);
        
        $this->call(SendEmailToUserTask::class, [$newPassword, $email]);
    }

    public function checkIfUserExist(string $email)
    {
        $user = $this->call(GetUserTask::class, [], [
            ['getByField' => ['email', $email]]
        ]);

        if(!$user) {
            throw new NotFoundHttpException('user not found in system');
        }

        return $user;
    }
}

