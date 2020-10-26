<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\ForgotPasswordUserSendMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailForgotPasswordSaleUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $tries = 1;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!empty($this->details['mailUser'])){
            $email = new ForgotPasswordUserSendMail($this->details);
            Mail::to($this->details['mailUser'])->send($email);
        } else {
            Log::error([
                'user_email' => $this->details['mailUser'],
                'forgot_password_user' => false
            ]);
        }
    }
}
