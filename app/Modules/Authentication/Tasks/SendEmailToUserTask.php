<?php

namespace App\Modules\Authentication\Tasks;

use App\Modules\Authentication\Emails\SendNewPasswordToUser;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Mail\Mailer;

class SendEmailToUserTask extends AbstractTask
{
    protected $mailer;

    /**
     * SendEmailToUserTask constructor.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function run(string $newPassword, string $email)
    {
        $this->mailer->to($email)
            ->send(new SendNewPasswordToUser($newPassword));
    }
}
