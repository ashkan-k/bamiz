<?php

namespace Modules\Payment\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Payment\Http\Controllers\BaseGatewayController;
use Modules\Reserve\Entities\Reserve;
use Modules\Setting\Entities\Setting;
use Modules\Sms\Helpers\sms_helper;
use Modules\Sms\Jobs\SendSmsJob;
use SoapClient;

class ZarinPalPaymentController extends BaseGatewayController
{
    public function pay(Reserve $reserve)
    {
        $result = $this->GetZarinPalClientStatus($reserve);
        if ($result[0]) {
            return redirect('https://sandbox.zarinpal.com/pg/StartPay/' . $result[1]->Authority);
        }

        $error_code = $result[1]->Status;
        return view('payment::front.fail', compact('error_code'));
    }

    public function call_back()
    {
        $result = $this->GetZarinPalClientCallBackStatus(\request('Authority'));
        if ($result[0]) {
            $payment = $result[1];

            $restaurant_manager_text = sprintf(sms_helper::$SMS_PATTERNS['reserve_success_restaurant_manager'], $payment->reserve->place->name, $payment->reserve->user->fullname(), str_replace('-', '/', $payment->reserve->date));
            dispatch(new SendSmsJob($payment->reserve->place->user->phone, $restaurant_manager_text));

            $user_text = sprintf(sms_helper::$SMS_PATTERNS['reserve_success_restaurant_manager'], $payment->reserve->place->name, $payment->reserve->user->fullname(), str_replace('-', '/', $payment->reserve->date));
            dispatch(new SendSmsJob($payment->reserve->place->user->phone, $user_text));

            $manager_phone = Setting::where('key', 'manager_phone_1')->first()->value;
            $manager_text = sprintf(sms_helper::$SMS_PATTERNS['reserve_success_manager'], $payment->reserve->place->get_type(), $payment->reserve->place->name, $payment->reserve->user->fullname(), str_replace('-', '/', $payment->reserve->date));
            dispatch(new SendSmsJob($manager_phone, $manager_text));

            return view('payment::front.success', compact('payment'));
        }
        return view('payment::front.fail');
    }
}
