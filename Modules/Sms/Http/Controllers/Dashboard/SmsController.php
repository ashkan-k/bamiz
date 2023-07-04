<?php

namespace Modules\Sms\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;

class SmsController extends Controller
{
    public function send_sms()
    {
        $users = User::all();
        return view('sms::dashboard.form', compact('users'));
    }
}
