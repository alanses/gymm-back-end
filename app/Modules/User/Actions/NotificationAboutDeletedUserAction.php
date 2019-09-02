<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Emails\SendNotificationAboutDeletingUser;
use App\Ship\Abstraction\AbstractAction;
use Illuminate\Contracts\Mail\Mailer;

class NotificationAboutDeletedUserAction extends AbstractAction
{
    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function run($id)
    {
        $user = $this->call(GetUserByIdAction::class, [$id]);

        $this->mailer->to($user->email)
            ->send(new SendNotificationAboutDeletingUser($user));
    }
}
