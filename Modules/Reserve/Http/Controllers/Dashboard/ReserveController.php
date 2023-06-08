<?php

namespace Modules\Reserve\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reserve\Entities\Reserve;
use Modules\Reserve\Http\Requests\ReserveRequest;

class ReserveController extends Controller
{
    use Responses;

    public function index()
    {
        return view('reserve::dashboard.reserve.list');
    }

    public function create()
    {
        return view('reserve::dashboard.reserve.form');
    }

    public function store(ReserveRequest $request)
    {
        $reserf = Reserve::create($request->validated());
        $reserf->options()->sync($request->option_id);
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'reserves.index');
    }

    public function edit(Reserve $reserf)
    {
        return view('reserve::dashboard.reserve.form', compact('reserf'));
    }

    public function update(ReserveRequest $request, Reserve $reserf)
    {
        $reserf->update($request->validated());
        $reserf->options()->sync($request->option_id);
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'reserves.index');
    }
}
