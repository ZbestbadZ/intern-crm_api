<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordUserSendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $dataMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataMail)
    {
        $this->dataMail = $dataMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $sendMailSaleUser = $this->subject($this->dataMail['subject'])
        ->view('mails.forgotpasswordsaleuser', [
                'verifyUrl' => $this->dataMail['verifyForgotPass'],
            ]);

        return $sendMailSaleUser;
    }
}
