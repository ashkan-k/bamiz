<?php

namespace Modules\Sms\Http\Controllers\Api;

use App\Http\Traits\Responses;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Sms\Http\Requests\SmsRequest;
use Modules\Sms\Http\Traits\SmsHelpers;
use Modules\Sms\Jobs\SendSmsJob;

class ApiSmsController extends Controller
{
    use Responses, SmsHelpers;

    public function send_sms_store(SmsRequest $request)
    {
//        dispatch(new SendSmsJob($request->users, $request->message));
        $this->send_sms($request->users, $request->message);
        return $this->SuccessResponse('با موفقیت ارسال شد.');
    }
}
