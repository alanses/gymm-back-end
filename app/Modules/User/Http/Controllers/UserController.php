<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\User\Actions\CreateUserAction;
use App\Modules\User\Actions\GetUserByIdAction;
use App\Modules\User\Entities\User;
use App\Modules\User\Http\Requests\CreateUserRequest;
use App\Modules\User\Http\Requests\GetUserByIdRequest;
use App\Modules\User\Transformers\UserTransformer;
use App\Ship\Parents\ApiController;
use ReflectionException;

class UserController extends ApiController
{
    /**
     * @param  CreateUserRequest  $request
     * @return mixed
     * @throws ReflectionException
     */
    public function createUser(CreateUserRequest $request)
    {
        /** @var User $user */
        $user = $this->call(CreateUserAction::class, [$request, User::$is_user]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param  CreateUserRequest  $request
     * @return mixed
     * @throws ReflectionException
     */

    public function createGym(CreateUserRequest $request)
    {
        $user = $this->call(CreateUserAction::class, [$request, User::$is_gym]);

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param  GetUserByIdRequest  $request
     * @return mixed
     * @throws ReflectionException
     */
    public function getUserById(GetUserByIdRequest $request)
    {
        /** @var User $user */
        $user = $this->call(GetUserByIdAction::class, [$request]);

        return $this->transform($user, UserTransformer::class);
    }
}
