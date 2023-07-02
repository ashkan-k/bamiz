<?php

namespace Modules\Payment\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Payment\Http\Controllers\BaseGatewayController;
use Modules\Reserve\Entities\Reserve;
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
            return view('payment::front.success', compact('payment'));
        }
        return view('payment::front.fail');
    }
}
