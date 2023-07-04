<?php

namespace Modules\Sms\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Sms\Http\Traits\SmsHelpers;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use SmsHelpers;

    protected $phones = null;
    protected $message = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($phones, $message)
    {
        $this->phones = $phones;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->send_sms($this->phones, $this->message);
    }
}
