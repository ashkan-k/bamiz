<?php

namespace Modules\ContactUs\Http\Controllers\Front;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ContactUs\Entities\ContactUs;
use Modules\ContactUs\Http\Requests\ContactUsRequest;

class FrontContactUsController extends Controller
{
    use Responses;

    public function contact_us()
    {
        return view('contactus::front.contact_us');
    }

    public function contact_us_submit(ContactUsRequest $request)
    {
        ContactUs::create($request->validated());
        return $this->SuccessRedirect('کاربر عزیز پیام تماس شما با موفقیت ثبت شد و توسط مدیریت رسیدگی خواهد شد.', 'contact_us');
    }
}
