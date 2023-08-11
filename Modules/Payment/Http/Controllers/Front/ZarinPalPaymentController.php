<?php

namespace Modules\Payment\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Payment\Entities\Payment;
use Modules\Payment\Http\Controllers\BaseGatewayController;
use Modules\Reserve\Entities\Reserve;
use Modules\Setting\Entities\Setting;
use Modules\Sms\Helpers\sms_helper;
use Modules\Sms\Jobs\SendSmsJob;
use SoapClient;

class ZarinPalPaymentController extends BaseGatewayController
{
//    private $start_pay_url  = 'https://sandbox.zarinpal.com/pg/StartPay/';
    private $start_pay_url  = 'https://www.zarinpal.com/pg/StartPay/';

//    private $wsdl_url = 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl';
    private $wsdl_url = 'https://zarinpal.com/pg/services/WebGate/wsdl';

    public function __construct()
    {
        $this->merchant_id = env('MERCHANT_CODE');
    }

    //

    public function pay(Reserve $reserve)
    {
        $result = $this->GetZarinPalClientStatus($reserve);
        if ($result[0]) {
            return redirect($this->start_pay_url . $result[1]->Authority);
        }

        $error_code = $result[1]->Status;
        return view('payment::front.fail', compact('error_code'));
    }

    public function call_back()
    {
        $result = $this->GetZarinPalClientCallBackStatus(\request('Authority'));
        if ($result[0]) {
            $payment = $result[1];

            // Send Sms for restaurant/cafe/hotel manager
            $restaurant_manager_text = sprintf(sms_helper::$SMS_PATTERNS['reserve_success_restaurant_manager'], $payment->reserve->place->name, $payment->reserve->user->fullname(), str_replace('-', '/', $payment->reserve->date));
            dispatch(new SendSmsJob($payment->reserve->place->user->phone, $restaurant_manager_text));

            // Send Sms for user who were reserved
            $user_text = sprintf(sms_helper::$SMS_PATTERNS['reserve_success_restaurant_manager'], $payment->reserve->place->name, $payment->reserve->user->fullname(), str_replace('-', '/', $payment->reserve->date));
            dispatch(new SendSmsJob($payment->reserve->place->user->phone, $user_text));

            // Send Sms for website,s manager
            $manager_phone = Setting::where('key', 'manager_phone_1')->first()->value;
            $manager_text = sprintf(sms_helper::$SMS_PATTERNS['reserve_success_manager'], $payment->reserve->place->get_type(), $payment->reserve->place->name, $payment->reserve->user->fullname(), str_replace('-', '/', $payment->reserve->date));
            dispatch(new SendSmsJob($manager_phone, $manager_text));

            return view('payment::front.success', compact('payment'));
        }
        return view('payment::front.fail');
    }

    //

    protected function GetZarinPalClientStatus($reserve)
    {
        abort_unless($reserve->user_id == auth()->id(), 404);

        $options = request('options');
        $options = $this->ConvertOptionsToInt($options);

        if ($options)
            $reserve->options()->sync($options);

        $this->totalPrice = $reserve->amount;

//        $options_price = $reserve->options()->sum('amount');
//        $this->totalPrice = round($reserve->amount + round($options_price));
//        $reserve->update(['amount' => $this->totalPrice]);

        ////////////////////////////////////////////////////////////
        /// در گاه پرداخت

        $MerchantID = $this->merchant_id; //Required
        $Amount = $this->totalPrice; //Amount will be based on Toman - Required
        $Description = "رزرو {$reserve->place->get_type()} {$reserve->place->name} از سایت بامیز"; // Required
        $Email = Setting::where('key', 'email')->first()->email; // Optional
        $Mobile = Setting::where('key', 'phone')->first()->phone; // Optional
        $CallbackURL = route('zarinpal.callback'); // Required

        $client = new SoapClient($this->wsdl_url, ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );

        if ($result->Status == 100) {

            Payment::create([
                'user_id' => auth()->user()->id,
                'reserve_id' => $reserve->id,
                'amount' => $this->totalPrice,
                'authority' => $result->Authority,
                'ip' => request()->ip(),
                'status' => false
            ]);

            return [true, $result];
            return redirect($this->start_pay_url . $result->Authority);

        } else {
            return [false, $result];
        }
    }

    protected function GetZarinPalClientCallBackStatus($authority)
    {
        $payment = Payment::where([
            ['authority', '=', $authority],
            ['user_id', '=', auth()->id()],
            ['status', '=', false],
        ])->firstOrFail();

        $MerchantID = $this->merchant_id;
        $Amount = $payment->amount;
        $Authority = $authority;

        if (\request('Status') == 'OK') {

            $client = new SoapClient($this->wsdl_url, ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {
                $payment->update(['status' => true, 'refID' => $result->RefID]);
                $payment->reserve()->update(['status' => 'success']);
                return [true, $payment];
            }
        }

        return [false, []];
    }
}
