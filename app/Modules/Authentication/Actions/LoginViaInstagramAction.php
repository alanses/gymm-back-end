<?php

namespace App\Modules\Authentication\Actions;

use App\Modules\Authentication\Http\Requests\SocialiteRequest;
use App\Modules\Authentication\Tasks\GenerateTokenDataForUserTask;
use App\Modules\Authentication\Tasks\MakeLoginViaInstagramTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\CreateUserTask;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Modules\User\Tasks\GetUserTask;
use App\Ship\Abstraction\AbstractAction;

class LoginViaInstagramAction extends AbstractAction
{
    public function run(SocialiteRequest $request) :User
    {
        $instagramUser = $this->call(MakeLoginViaInstagramTask::class, [$request->token]);

        $userFromDB = $this->call(GetUserTask::class, [], [
            ['getByField' => ['email', $instagramUser->email]]
        ]);


        if(!$userFromDB) {
            $userFromDB = $this->createUser($instagramUser);
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