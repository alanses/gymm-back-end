<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Transformers\ListUsersForAdminTransformer;
use App\Modules\User\Actions\DeleteUserAction;
use App\Modules\User\Actions\GetUsersForAdminAction;
use App\Ship\Parents\ApiController;

class AdminController extends ApiController
{
    public function getListUsers()
    {
        $users = $this->call(GetUsersForAdminAction::class);

        return ListUsersForAdminTransformer::collection($users);
    }

    public function deleteUser($id)
    {
        $this->call(DeleteUserAction::class, [$id]);

        $this->success();
    }
}
