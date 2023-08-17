<?php

namespace Modules\Sms\Http\Traits;

use Illuminate\Support\Facades\Http;

trait SmsHelpers
{
    public function send_sms($phones, $message)
    {
        if (is_array($phones)){
            $phones = implode(',', $phones);
        }
        $username = env('SMS_USERNAME');
        $password = env('SMS_PASSWORD');
        $sender = env('SMS_SENDER_NUMBER');

        try {
//            $sms_url = "http://sms.rajat.ir/send_line.php?username=$username&password=$password&to=$phones&fori=2&from=$sender&text=$message";
//            $response = Http::get($sms_url);
//
//            if ($response->status() == 200 && $response->json() == null) {
//                return true;
//            }
            return false;
        }catch (\Exception $exception){}
    }
}
