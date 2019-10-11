<?php

namespace App\Modules\Authentication\Http\Controllers;

use App\Modules\Authentication\Actions\ApiLoginAction;
use App\Modules\Authentication\Actions\RestorePasswordAction;
use App\Modules\Authentication\Actions\SendNewPasswordOnEmailAction;
use App\Modules\Authentication\Http\Requests\ForgotPasswordRequest;
use App\Modules\Authentication\Http\Requests\LoginRequest;
use App\Modules\Authentication\Http\Requests\RestorePasswordRequest;
use App\Modules\Authentication\Tasks\UserIsAdminTask;
use App\Modules\User\Actions\FindUserByEmailAction;
use App\Modules\User\Entities\User;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Modules\User\Transformers\UserTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends ApiController
{
    /**
     * @param  LoginRequest  $request
     * @return UserTransformer
     * @throws \ReflectionException
     */
    public function login(LoginRequest $request)
    {
        $result = $this->call(ApiLoginAction::class, [
            $request,
            env('CLIENT_WEB_ADMIN_ID'),
            env('CLIENT_WEB_ADMIN_SECRET'),
        ]);

        /** @var User $user */
        $user = $this->call(FindUserByEmailAction::class, [$request->email]);
        $user['response_content'] = $result['response-content'];

        return $this->transform($user, UserTransformer::class);
    }

    /**
     * @param ForgotPasswordRequest $request
     * @return array
     */
    public function sendNewPassword(ForgotPasswordRequest $request)
    {
        $this->call(SendNewPasswordOnEmailAction::class, [$request->email]);

        return $this->success('ok');
    }

    /**
     * @param RestorePasswordRequest $request
     * @return array
     */
    public function restorePassword(RestorePasswordRequest $request)
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        $this->call(RestorePasswordAction::class, [
            $request->old_password,
            $request->new_password,
            $user->id
        ]);

        return $this->success('ok');
    }

    public function loginForAdmin(LoginRequest $request)
    {
        $result = $this->call(ApiLoginAction::class, [
            $request,
            env('CLIENT_WEB_ADMIN_ID'),
            env('CLIENT_WEB_ADMIN_SECRET'),
        ]);

        /** @var User $user */
        $user = $this->call(FindUserByEmailAction::class, [$request->email]);

        $this->call(UserIsAdminTask::class, [$user]);

        $user['response_content'] = $result['response-content'];

        return $this->transform($user, UserTransformer::class);
    }
}
