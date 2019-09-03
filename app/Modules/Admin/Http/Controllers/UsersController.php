<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Transformers\UserAdminTransformer;
use App\Modules\User\Actions\GetUserByIdAction;
use App\Modules\User\Actions\NotificationAboutDeletedUserAction;
use App\Modules\User\Http\Requests\GetUserByIdRequest;
use App\Ship\Parents\ApiController;
use App\Modules\Admin\Transformers\ListUsersForAdminTransformer;
use App\Modules\User\Actions\DeleteUserAction;
use App\Modules\User\Actions\GetUsersForAdminAction;
use Illuminate\Http\Request;

class UsersController extends ApiController
{
    public function getListUsers(Request $request)
    {
        $users = $this->call(GetUsersForAdminAction::class, [$request]);

        return ListUsersForAdminTransformer::collection($users);
    }

    public function deleteUser(GetUserByIdRequest $request)
    {
        $this->call(NotificationAboutDeletedUserAction::class, [$request->id]);

        $this->call(DeleteUserAction::class, [$request->id]);

        $this->success();
    }

    public function getUserByID(GetUserByIdRequest $request)
    {
        $user = $this->call(GetUserByIdAction::class, [$request->id]);

        return new UserAdminTransformer($user);
    }
}
