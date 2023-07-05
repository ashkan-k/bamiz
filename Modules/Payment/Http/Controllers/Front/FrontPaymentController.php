<?php

namespace Modules\Payment\Http\Controllers\Front;

use Illuminate\Routing\Controller;
use Modules\Payment\Entities\Payment;
use Modules\Payment\Http\Requests\PaymentRequest;
use Modules\Reserve\Entities\Reserve;
use Modules\Setting\Entities\Setting;
use SoapClient;

class FrontPaymentController extends Controller
{
    protected $merchant_id;
    protected $totalPrice;

    public function __construct()
    {
        $this->merchant_id = env('MERCHANT_CODE');
    }

    private function ConvertOptionsToInt($options)
    {
        $options = explode(',', $options);
        foreach ($options as $key => $op) {
            if ($op != null && $op != '') {
                $options[$key] = intval($op);
            } else {
                unset($options[$key]);
            }
        }
        return $options;
    }

    //

    public function show()
    {
        return view('payment');
    }

    public function pay(PaymentRequest $request, Reserve $reserve)
    {
        abort_unless($reserve->user_id == auth()->id(), 404);

        $options = $request->get('options');
        $options = $this->ConvertOptionsToInt($options);

        if ($options) $reserve->options()->sync($options);

        $options_price = $reserve->options()->sum('amount');
        $this->totalPrice = round($reserve->amount + round($options_price));

        $reserve->update(['amount' => $this->totalPrice]);

        ////////////////////////////////////////////////////////////
        /// در گاه پرداخت

        $MerchantID = $this->merchant_id; //Required
        $Amount = $this->totalPrice; //Amount will be based on Toman - Required
        $Description = "رزرو {$reserve->place->get_type()} {$reserve->place->name} از سایت بامیز"; // Required
        $Email = Setting::where('key', 'email')->first()->email; // Optional
        $Mobile = Setting::where('key', 'phone')->first()->phone; // Optional
        $CallbackURL = env('APP_URL') . '/payment/callback'; // Required


        try {
            $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        }catch (\Exception $exception){
            abort(503, 'متاسفانه مشکلی در ارتباط پیش آمد. لطفا اینترنت خود را چک کنید و دوباره امتحان کنید.');
        }

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
                'ip' => $request->ip(),
                'status' => false
            ]);

            return redirect('https://sandbox.zarinpal.com/pg/StartPay/' . $result->Authority);

        } else {
            echo 'ERR: ' . $result->Status;
        }
    }

    public function call_back()
    {
        $payment = Payment::where('authority', \request('Authority'))->first();

        $MerchantID = $this->merchant_id;
        $Amount = $payment->amount;
        $Authority = \request('Authority');

        if (\request('Status') == 'OK') {

            $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {

                $payment->update(['status' => true, 'refID' => $result->RefID]);
                $payment->reserve()->update(['status' => true]);

                return view('payment::front.success', compact('payment'));
            } else {
                $error_code = $result->Status;
                return view('payment::front.fail', compact('error_code'));
            }
        } else {
            return view('payment::front.fail');
        }
    }
}
