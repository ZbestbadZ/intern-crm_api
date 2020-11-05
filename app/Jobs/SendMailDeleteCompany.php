<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeleteCompanySendMail;

class SendMailDeleteCompany implements ShouldQueue
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
        if(!empty($this->details['mailSaleAdmin'])){
            $email = new DeleteCompanySendMail($this->details);
            Mail::to($this->details['mailSaleAdmin'])->send($email);
        } else {
            Log::error([
                'mail_sale_admin' => $this->details['mailSaleAdmin'],
                'status' => false
            ]);
        }
    }
}
