<?php

namespace App\Modules\Admin\Emails;

use App\Modules\Gym\Entities\RatingForTrainer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificationForAdminAboutReview extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var RatingForTrainer
     */
    private $ratingForTrainer;

    /**
     * Create a new message instance.
     *
     * @param RatingForTrainer $ratingForTrainer
     */
    public function __construct(RatingForTrainer $ratingForTrainer)
    {
        $this->ratingForTrainer = $ratingForTrainer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notification for admin about review')
            ->view('admin::notification-for-admin-about-review', [
                'review' => $this->ratingForTrainer
            ]);
    }
}
