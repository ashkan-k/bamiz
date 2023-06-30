<?php

namespace Modules\ContactUs\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ContactUs\Entities\ContactUs;
use Modules\ContactUs\Http\Requests\ContactUsRequest;

class ContactUsController extends Controller
{
    use Responses;

    public function index()
    {
        return view('contactus::dashboard.list');
    }
}
