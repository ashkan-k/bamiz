<?php

namespace Modules\Payment\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller
{
    use Responses;

    public function index()
    {
        return view('payment::dashboard.list');
    }
}
