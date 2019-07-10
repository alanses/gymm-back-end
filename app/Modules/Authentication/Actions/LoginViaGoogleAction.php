<?php

namespace App\Modules\Authentication\Actions;

use App\Modules\Authentication\Http\Requests\SocialiteRequest;
use App\Modules\Authentication\Tasks\GenerateTokenDataForUserTask;
use App\Modules\Authentication\Tasks\MakeLoginViaGoogleTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\CreateUserTask;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;

class LoginViaGoogleAction extends AbstractAction
{
    public function run(SocialiteRequest $request) :User
    {
        $googleUser = $this->call(MakeLoginViaGoogleTask::class, [$request->token]);

        $userFromDB = $this->call(GetUserTask::class, [], [
            ['getByField' => ['email', $googleUser->email]]
        ]);


        if(!$userFromDB) {
            $userFromDB = $this->createUser($googleUser);
        }

        $userFromDB = $this->call(GenerateTokenDataForUserTask::class, [$userFromDB]);

        return $userFromDB;
    }


    private function createUser($facebookUser)
    {
        return $this->call(CreateUserTask::class, [
            [
                'name' => $facebookUser->name,
                'email' => $facebookUser->email
            ]
        ]);
    }
}
