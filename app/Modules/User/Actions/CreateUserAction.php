<?php

namespace App\Modules\User\Actions;

use App\Modules\Authentication\Tasks\GenerateTokenDataForUserTask;
use App\Modules\Gym\Tasks\CreateGymTask;
use App\Modules\User\Entities\User;
use App\Modules\User\Http\Requests\CreateUserRequest;
use App\Modules\User\Tasks\CreateUserTask;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Http\Request;

class CreateUserAction extends AbstractAction
{
    /**
     * @param  Request  $request
     * @return User
     */
    public function run(CreateUserRequest $request, $userType)
    {
        /** @var array $requestData */
        $requestData = $request->sanitizeInput(['name', 'email', 'password']);

        $this->setType($requestData, $userType);

        /** @var User $user */
        $user = $this->call(CreateUserTask::class, [$requestData]);

        $user = $this->call(GenerateTokenDataForUserTask::class, [$user]);

        $this->call(CreateGymTask::class, [
            [
                'user_id' => $user->id
            ]
        ]);

        return $user;
    }

    public function setType(?array &$requestData, &$userType)
    {
        $requestData['user_type'] = $userType;
    }
}
