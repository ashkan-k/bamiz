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
        return view('setting::dashboard.list');
    }

    public function create()
    {
        return view('setting::dashboard.form');
    }

    public function store(ContactUsRequest $request)
    {
        ContactUs::create($request->validated());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'contact_us.index');
    }

    public function edit(ContactUs $contactUs)
    {
        return view('setting::dashboard.form', compact('contactUs'));
    }

    public function update(ContactUsRequest $request, ContactUs $contactUs)
    {
        $contactUs->update($request->validated());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'contact_us.index');
    }
}
