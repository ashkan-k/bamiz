<?php

namespace Modules\Place\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use Illuminate\Routing\Controller;
use Modules\Place\Entities\HotelRoom;
use Modules\Place\Http\Requests\HotelRoomRequest;

class HotelRoomController extends Controller
{
    use Responses;

    public function index()
    {
        return view('place::dashboard.hotel_rooms.list');
    }

    public function create()
    {
        return view('place::dashboard.hotel_rooms.form');
    }

    public function store(HotelRoomRequest $request)
    {
        HotelRoom::create($request->validated());

        $next_url = \request('next_url');
        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ثبت شد.', $next_url);
    }

    public function edit(HotelRoom $hotelRoom)
    {
        return view('place::dashboard.hotel_rooms.form', compact('table'));
    }

    public function update(HotelRoomRequest $request, HotelRoom $table)
    {
        $table->update($request->validated());

        $next_url = \request('next_url');
        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ویرایش شد.', $next_url);
    }
}
