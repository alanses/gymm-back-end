<?php

namespace App\Modules\Authentication\Actions;

use App\Modules\Authentication\Http\Requests\SocialiteRequest;
use App\Modules\Authentication\Tasks\GenerateTokenDataForUserTask;
use App\Modules\Authentication\Tasks\MakeLoginViaVkontacteTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\CreateUserDetailTask;
use App\Modules\User\Tasks\CreateUserTask;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;

class LoginViaVkontakteAction extends AbstractAction
{
    public function run(SocialiteRequest $request) :User
    {
        $vkUser = $this->call(MakeLoginViaVkontacteTask::class, [$request->token]);

        $userFromDB = $this->call(GetUserTask::class, [], [
            ['getByField' => ['email', $vkUser->email]]
        ]);

        if(!$userFromDB) {
            $userFromDB = $this->createUser($vkUser);
            $this->createUserDetail($userFromDB);
        }

        $userFromDB = $this->call(GenerateTokenDataForUserTask::class, [$userFromDB]);

        return $userFromDB;
    }


    private function createUser($facebookUser)
    {
        return $this->call(CreateUserTask::class, [
            [
                'name' => $facebookUser->name,
                'login' => $facebookUser->login
            ]
        ]);
    }

    private function createUserDetail(User $user)
    {
        $this->call(CreateUserDetailTask::class, [
            [
                'user_id' => $user->id
            ]
        ]);
    }
}
