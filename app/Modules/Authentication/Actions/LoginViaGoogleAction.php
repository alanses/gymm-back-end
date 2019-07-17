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
use Illuminate\Http\Request;

class LoginViaGoogleAction extends AbstractAction
{
    public function run(SocialiteRequest $request) :User
    {
//        $googleUser = $this->call(MakeLoginViaGoogleTask::class, [$request->token]);

        $userFromDB = $this->call(GetUserTask::class, [], [
            ['getByField' => ['email', $request->email]]
        ]);


        if(!$userFromDB) {
            $userFromDB = $this->createUser($request);
        }

        $userFromDB = $this->call(GenerateTokenDataForUserTask::class, [$userFromDB]);

        return $userFromDB;
    }


    private function createUser(SocialiteRequest $request)
    {
        return $this->call(CreateUserTask::class, [
            [
                'name' => $request->name,
                'email' => $request->email,
                'user_type' => User::$is_user
            ]
        ]);
    }
}
