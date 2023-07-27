<?php


namespace Modules\Payment\Http\Controllers;

use Modules\Payment\Entities\Payment;
use Modules\Setting\Entities\Setting;
use SoapClient;
use Illuminate\Routing\Controller;

class BaseGatewayController extends Controller
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
        $CallbackURL = env('APP_URL') . '/payment/callback'; // Required

        $client = new SoapClient('https://sandbox.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

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
            return redirect('https://sandbox.zarinpal.com/pg/StartPay/' . $result->Authority);

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
                $payment->reserve()->update(['status' => 'success']);
                return [true, $payment];
            }
        }

        return [false, []];
    }
}
