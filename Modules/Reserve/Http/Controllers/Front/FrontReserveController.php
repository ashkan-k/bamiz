<?php

namespace Modules\Reserve\Http\Controllers\Front;

use App\Http\Traits\ImageUploader;
use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Category\Entities\Category;
use Modules\Place\Entities\HotelRoom;
use Modules\Place\Entities\Place;
use Modules\Place\Entities\Table;
use Modules\Place\Http\Requests\PlaceRequest;
use Modules\Reserve\Entities\Reserve;
use Modules\Reserve\Entities\ReserveType;
use Modules\Reserve\Http\Requests\ReserveRequest;
use Modules\Setting\Entities\Setting;

class FrontReserveController extends Controller
{
    public function reserve(ReserveRequest $request, Place $place)
    {
        $data = $request->validated();

        $data['children_guest_count'] = $data['children_guest_count'] ?? 0;

        if (isset($data['table_id'])) {
            $table = Table::find($data['table_id']);
            $data['amount'] = $table->price;
        } elseif (isset($data['reserve_type_id'])) {
            $reserve_type = ReserveType::find($data['reserve_type_id']);
            $data['amount'] = $reserve_type->price;
        } elseif (isset($data['hotel_room_id'])) {
            $hotel_room = HotelRoom::find($data['hotel_room_id']);
            $data['amount'] = $hotel_room->price;
        }

        if (!isset($data['amount']) || $data['amount'] <= 0) {
            throw ValidationException::withMessages(['amount' => 'لطفا اطلاعات را تکمیل کنید! قیمت نهایی رزرو نمی تواند 0 باشد!'])->status(400);
        }

        $reserve = auth()->user()->reserves()->create($data);
        if ($request->option_id) {
            $reserve->options()->sync($request->option_id);

            $reserve->amount += $reserve->options()->sum('amount');
            $reserve->save();
        }

        return view('reserve::front.reserve', compact('data', 'place', 'reserve'));
    }
}
