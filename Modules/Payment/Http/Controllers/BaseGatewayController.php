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

    protected function ConvertOptionsToInt($options)
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
}
