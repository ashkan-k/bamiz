<?php

namespace Modules\Reserve\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reserve\Entities\ReserveType;
use Modules\Reserve\Http\Requests\ReserveTypeRequest;

class ReserveTypeController extends Controller
{
    use Responses;

    public function index()
    {
        return view('reserve::dashboard.reserve-type.list');
    }

    public function create()
    {
        return view('reserve::dashboard.reserve-type.form');
    }

    public function store(ReserveTypeRequest $request)
    {
        ReserveType::create($request->validated());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'reserve-types.index');
    }

    public function edit(ReserveType $reserve_type)
    {
        return view('reserve::dashboard.reserve-type.form', compact('reserve_type'));
    }

    public function update(ReserveTypeRequest $request, ReserveType $reserve_type)
    {
        $reserve_type->update($request->validated());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'reserve-types.index');
    }
}
