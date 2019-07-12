<?php

namespace App\Modules\Authentication\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewPasswordToUser extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var string
     */
    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $password)
    {
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have new message from Gym')
            ->view('authentication::send-password-to-user', [
                'password' => $this->password,
            ]);
    }
}
