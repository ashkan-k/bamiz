<?php

namespace Modules\Place\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Routing\Controller;
use Modules\Place\Entities\Table;
use Modules\Place\Http\Requests\TableRequest;

class TableController extends Controller
{
    use Responses;

    public function index()
    {
        return view('place::dashboard.tables.list');
    }

    public function create()
    {
        return view('place::dashboard.tables.form');
    }

    public function store(TableRequest $request)
    {
        Table::create($request->validated());

        $next_url = \request('next_url');
        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ثبت شد.', $next_url);
    }

    public function edit(Table $table)
    {
        return view('place::dashboard.tables.form', compact('table'));
    }

    public function update(TableRequest $request, Table $table)
    {
        $table->update($request->validated());

        $next_url = \request('next_url');
        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ویرایش شد.', $next_url);
    }
}
