<?php

namespace App\Modules\Authentication\Actions;

use App\Modules\Authentication\Http\Requests\SocialiteRequest;
use App\Modules\Authentication\Tasks\GenerateTokenDataForUserTask;
use App\Modules\Authentication\Tasks\MakeLoginViaFacebookTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\CreateUserDetailTask;
use App\Modules\User\Tasks\CreateUserTask;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;

class LoginViaFacebookAction extends AbstractAction
{
    public function run(SocialiteRequest $request) :User
    {
        $facebookUser = $this->call(MakeLoginViaFacebookTask::class, [$request->token]);

        $userFromDB = $this->call(GetUserTask::class, [], [
            ['getByField' => ['email', $facebookUser->email]]
        ]);

        if(!$userFromDB) {
            $userFromDB = $this->createUser($facebookUser, $request->type);
            $this->createUserDetail($userFromDB);
        }


        $userFromDB = $this->call(GenerateTokenDataForUserTask::class, [$userFromDB]);

        return $userFromDB;
    }

    /**
     * @param $facebookUser
     * @param string $user_type
     * @return User
     */

    private function createUser($facebookUser, string $user_type) :User
    {
        return $this->call(CreateUserTask::class, [
            [
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'user_type' => User::getUserType($user_type)
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
