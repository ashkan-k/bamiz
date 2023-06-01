<?php

namespace Modules\Common\Http\Controllers;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Common\Entities\Province;
use Modules\Common\Http\Requests\ProvinceRequest;

class ProvinceController extends Controller
{
    use Responses;

    public function index()
    {
        return view('common::dashboard.province.list');
    }

    public function create()
    {
        return view('common::dashboard.province.form');
    }

    public function store(ProvinceRequest $request)
    {
        Province::create($request->validated());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'provinces.index');
    }

    public function edit(Province $province)
    {
        return view('common::dashboard.province.form', compact('province'));
    }

    public function update(ProvinceRequest $request, Province $province)
    {
        $province->update($request->validated());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'provinces.index');
    }
}
