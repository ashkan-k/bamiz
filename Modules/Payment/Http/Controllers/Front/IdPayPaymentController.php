<?php

namespace Modules\Payment\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Traits\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Modules\Payment\Entities\Payment;
use Modules\Payment\Http\Controllers\BaseGatewayController;
use Modules\Reserve\Entities\Reserve;
use Modules\Setting\Entities\Setting;
use Modules\Sms\Helpers\sms_helper;
use Modules\Sms\Jobs\SendSmsJob;
use SoapClient;

class IdPayPaymentController extends BaseGatewayController
{
    use Helpers;

    public function __construct()
    {
        $this->merchant_id = env('ID_PAY_API_KEY');
    }

    //

    public function pay(Reserve $reserve)
    {
        $result = $this->GetIdPayClientStatus($reserve);
        if ($result[0]) {
            return redirect($result[1]);
        }

        $error_code = $result[1];
        return view('payment::front.fail', compact('error_code'));
    }

    public function call_back()
    {
        $result = $this->GetIdPayClientCallBackStatus();
        if ($result[0]) {
            $payment = $result[1];

            // Send Sms for restaurant/cafe/hotel manager
            $restaurant_manager_text = sprintf(sms_helper::$SMS_PATTERNS['reserve_success_restaurant_manager'], $payment->reserve->place->name, $payment->reserve->user->fullname(), str_replace('-', '/', $payment->reserve->date));
//            dispatch(new SendSmsJob($payment->reserve->place->user->phone, $restaurant_manager_text));
            $this->send_sms($payment->reserve->place->user->phone, $restaurant_manager_text);

            // Send Sms for user who were reserved
            $user_text = sprintf(sms_helper::$SMS_PATTERNS['reserve_success_user'], $payment->reserve->place->name, str_replace('-', '/', $payment->reserve->date));
//            dispatch(new SendSmsJob($payment->reserve->place->user->phone, $user_text));
            $this->send_sms($payment->reserve->place->user->phone, $user_text);

            // Send Sms for website,s manager
            $manager_phone = Setting::where('key', 'manager_phone_1')->first()->value;
            $manager_text = sprintf(sms_helper::$SMS_PATTERNS['reserve_success_manager'], $payment->reserve->place->name, $payment->reserve->user->fullname(), str_replace('-', '/', $payment->reserve->date));
//            dispatch(new SendSmsJob($manager_phone, $manager_text));
            $this->send_sms($manager_phone, $manager_text);

            return view('payment::front.success', compact('payment'));
        }
        return view('payment::front.fail');
    }

    //

    protected function GetIdPayClientStatus($reserve)
    {
        abort_unless($reserve->user_id == auth()->id(), 404);

        $options = request('options');
        $options = $this->ConvertOptionsToInt($options);

        if ($options)
            $reserve->options()->sync($options);

        $this->totalPrice = $reserve->amount;

        ////////////////////////////////////////////////////////////
        /// در گاه پرداخت

        $MerchantID = $this->merchant_id; //Required
        $Amount = $this->totalPrice; //Amount will be based on Toman - Required
        $Description = "رزرو {$reserve->place->get_type()} {$reserve->place->name} از سایت بامیز"; // Required
        $Email = $reserve->user && $reserve->user->email ? $reserve->user->email : Setting::where('key', 'email')->first()->email; // Optional
        $Mobile = $reserve->user ? $reserve->user->phone : '---'; // Optional
        $UserName = $reserve->user ? $reserve->user->fullname() : '---'; // Optional
        $CallbackURL = route('id-pay.callback'); // Required

        $data = [
            'order_id' => $this->RandomNumber(5),
            'amount' => $Amount * 10,
            'name' => $UserName,
            'phone' => $Mobile,
            'mail' => $Email,
            'desc' => $Description,
            'callback' => $CallbackURL,
        ];

        $result = Http::withHeaders([
            'X-API-KEY' => $MerchantID,
            'X-SANDBOX' => 1,
            'Content-Type' => 'application/json'
        ])->post('https://api.idpay.ir/v1.1/payment', $data);

        if ($result->status() == 201) {

            Payment::create([
                'user_id' => auth()->user()->id,
                'reserve_id' => $reserve->id,
                'amount' => $this->totalPrice,
                'authority' => $result->json('id'),
                'ip' => request()->ip(),
                'status' => false
            ]);

            return [true, $result->json('link')];
        } else {
            return [false, $result->json('error_code')];
        }
    }

    protected function GetIdPayClientCallBackStatus()
    {
        if (\request('status') != 10) {
            return [false, []];
        }

        $payment = Payment::where([
            ['authority', '=', \request('id')],
            ['user_id', '=', auth()->id()],
            ['status', '=', false],
        ])->firstOrFail();

        $data = [
            'id' => \request('id'),
            'order_id' => \request('order_id'),
        ];

        $result = Http::withHeaders([
            'X-API-KEY' => $this->merchant_id,
            'X-SANDBOX' => 1,
            'Content-Type' => 'application/json'
        ])->post('https://api.idpay.ir/v1.1/payment/verify', $data);

        if ($result->status() == 200) {
            $payment->update(['status' => true, 'refID' => $result->json('payment')['track_id']]);
            $payment->reserve()->update(['status' => 'success']);
            return [true, $payment];
        }

        return [false, []];
    }
}
