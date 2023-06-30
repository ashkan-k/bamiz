<?php

namespace Modules\WorkTime\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\WorkTime\Entities\WorkTime;
use Modules\WorkTime\Http\Requests\WorkTimeRequest;

class WorkTimeController extends Controller
{
    use Responses;

    public function index()
    {
        return view('worktime::dashboard.list');
    }

    public function create()
    {
        return view('worktime::dashboard.form');
    }

    public function store(WorkTimeRequest $request)
    {
        $data = $request->validated();
        $data['week_days'] =join(', ' , $data['week_days']);

        WorkTime::create($data);
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'worktimes.index');
    }

    public function edit(WorkTime $worktime)
    {
        return view('worktime::dashboard.form', compact('worktime'));
    }

    public function update(WorkTimeRequest $request, WorkTime $worktime)
    {
        $data = $request->validated();
        $data['week_days'] =join(', ' , $data['week_days']);

        $worktime->update($data);
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'worktimes.index');
    }
}
