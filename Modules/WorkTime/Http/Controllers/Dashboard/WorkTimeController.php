<?php

namespace Modules\WorkTime\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Place\Entities\Place;
use Modules\WorkTime\Entities\WorkTime;
use Modules\WorkTime\Http\Requests\WorkTimeRequest;

class WorkTimeController extends Controller
{
    use Responses;

    private function GetPlaceInstance()
    {
        $place = null;
        if (\request('place_id')){
            $place = Place::findOrFail(\request('place_id'));
        }
        return $place;
    }

    //

    public function index()
    {
        return view('worktime::dashboard.list');
    }

    public function create()
    {
        $place = $this->GetPlaceInstance();
        return view('worktime::dashboard.form', compact('place'));
    }

    public function store(WorkTimeRequest $request)
    {
        $data = $request->validated();
        $data['week_days'] =join(', ' , $data['week_days']);

        WorkTime::create($data);
        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ثبت شد.', $request->next_url);
    }

    public function edit(WorkTime $worktime)
    {
        $place = $this->GetPlaceInstance();
        return view('worktime::dashboard.form', compact('worktime', 'place'));
    }

    public function update(WorkTimeRequest $request, WorkTime $worktime)
    {
        $data = $request->validated();
        $data['week_days'] =join(', ' , $data['week_days']);

        $worktime->update($data);
        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ویرایش شد.', $request->next_url);
    }
}
