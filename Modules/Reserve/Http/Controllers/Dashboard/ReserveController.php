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
        Reserve::create($request->validated());
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'reserves.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('reserve::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('reserve::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
