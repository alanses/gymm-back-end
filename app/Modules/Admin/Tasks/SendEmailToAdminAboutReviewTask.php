<?php

namespace App\Modules\Admin\Tasks;

use App\Modules\Admin\Emails\NotificationForAdminAboutReview;
use App\Modules\Gym\Entities\RatingForTrainer;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Mail\Mailer;

class SendEmailToAdminAboutReviewTask extends AbstractTask
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

    public function run(string $email, RatingForTrainer $ratingForTrainer)
    {
        return $this->mailer->to($email)
            ->send(new NotificationForAdminAboutReview($ratingForTrainer));
    }
}
