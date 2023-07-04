<?php

namespace Modules\Reserve\Http\Controllers\Front;

use App\Http\Traits\ImageUploader;
use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Place\Entities\Place;
use Modules\Place\Http\Requests\PlaceRequest;
use Modules\Reserve\Entities\Reserve;
use Modules\Reserve\Http\Requests\ReserveRequest;
use Modules\Setting\Entities\Setting;

class FrontReserveController extends Controller
{
    public function reserve(ReserveRequest $request, Place $place)
    {
        $data = $request->validated();
        dd($request->all());
        $data['amount'] = Setting::getPriceFromSettings() * $data['guest_count'];
        $reserve = auth()->user()->reserves()->create($data);
        return view('reserve::front.reserve' , compact('data', 'place', 'reserve'));
    }
}
