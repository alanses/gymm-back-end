<?php

namespace App\Modules\User\Tasks;

use App\Modules\User\Emails\UserWasCreated;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Collection;
use App\Ship\Abstraction\AbstractTask;

class SendEmailTask extends AbstractTask
{
    protected $mailer;

    /**
     * SendEmailTask constructor.
     * @param  Mailer  $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function run(Collection $data)
    {
        $this->mailer->to($data->get('email'))
            ->send(new UserWasCreated($data));
    }
}
