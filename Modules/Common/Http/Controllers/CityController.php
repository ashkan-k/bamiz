<?php

namespace Modules\Common\Http\Controllers;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\Common\Http\Requests\CityRequest;
use Modules\Common\Http\Requests\ProvinceRequest;

class CityController extends Controller
{
    use Responses;

    public function index()
    {
        return view('common::dashboard.city.list');
    }

    public function create()
    {
        return view('common::dashboard.city.form');
    }

    public function store(CityRequest $request)
    {
        City::create($request->validated());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'cities.index');
    }

    public function edit(City $city)
    {
        return view('common::dashboard.city.form', compact('city'));
    }

    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'cities.index');
    }
}
