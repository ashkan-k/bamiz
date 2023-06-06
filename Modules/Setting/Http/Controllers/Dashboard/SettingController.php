<?php

namespace Modules\Setting\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Entities\Setting;
use Modules\Setting\Http\Requests\SettingRequest;

class SettingController extends Controller
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

    public function store(SettingRequest $request)
    {
        Setting::create(array_merge($request->validated()));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'settings.index');
    }

    public function edit(Setting $setting)
    {
        return view('setting::dashboard.form', compact('setting'));
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        $setting->update(array_merge($request->validated()));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'settings.index');
    }
}
