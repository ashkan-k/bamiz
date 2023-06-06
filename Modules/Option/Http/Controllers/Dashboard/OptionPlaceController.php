<?php

namespace Modules\Option\Http\Controllers\Dashboard;

use App\Http\Traits\Helpers;
use App\Http\Traits\Responses;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Option\Http\Requests\OptionPlaceRequest;
use Modules\Place\Entities\Place;

class OptionPlaceController extends Controller
{
    use Responses;

    public function index()
    {
        return view('option::dashboard.option_place.list');
    }

    public function create()
    {
        return view('option::dashboard.option_place.form');
    }

    public function store(OptionPlaceRequest $request)
    {
        $place = Place::findOrFail($request->place_id);
        $place->options()->sync($request->option_id);

        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ثبت شد.', $request->next_url);
    }
}
