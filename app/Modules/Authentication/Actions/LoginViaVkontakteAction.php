<?php

namespace App\Modules\Authentication\Actions;

use App\Modules\Authentication\Http\Requests\SocialiteRequest;
use App\Modules\Authentication\Tasks\GenerateTokenDataForUserTask;
use App\Modules\Authentication\Tasks\MakeLoginViaVkontacteTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\CreateUserTask;
use App\Modules\User\Tasks\GetAllUsersTask;
use App\Ship\Abstraction\AbstractAction;

class LoginViaVkontakteAction extends AbstractAction
{
    public function run(SocialiteRequest $request) :User
    {
        $facebookUser = $this->call(MakeLoginViaVkontacteTask::class, [$request->token]);

        $userFromDB = $this->call(GetAllUsersTask::class, [], [
            ['findById' => ['email', $facebookUser->email]]
        ])->first();


        if(!$userFromDB) {
            $userFromDB = $this->createUser($facebookUser);
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
