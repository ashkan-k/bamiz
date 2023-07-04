<?php

namespace Modules\Cooperation\Http\Controllers\Front;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ContactUs\Entities\ContactUs;
use Modules\ContactUs\Http\Requests\ContactUsRequest;
use Modules\Cooperation\Entities\Cooperation;
use Modules\Cooperation\Http\Requests\CooperationRequest;

class FrontCooperationController extends Controller
{
    use Responses, Uploader;

    public function cooperation()
    {
        return view('cooperation::front.cooperation');
    }

    public function cooperation_submit(CooperationRequest $request)
    {
        $file = $this->UploadFile($request, 'file', 'cooperations_files', $request->first_name . '-' . $request->last_name);

        Cooperation::create(array_merge($request->all(), ['file' => $file]));
        return $this->SuccessRedirect('کاربر عزیز درخواست همکاری شما با موفقیت ثبت شد و پس از بررسی توسط ادمین با شما تماس گرفته خواهد شد.', 'cooperation');
    }
}
