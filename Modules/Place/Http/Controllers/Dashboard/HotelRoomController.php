<?php

namespace Modules\Place\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Routing\Controller;
use Modules\Place\Entities\HotelRoom;
use Modules\Place\Http\Requests\HotelRoomRequest;

class HotelRoomController extends Controller
{
    use Responses, Uploader;

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
        $image = $this->UploadFile($request, 'image', 'hotel_room_images', $request->title);
        HotelRoom::create(array_merge($request->all(), ['image' => $image]));

        $next_url = \request('next_url');
        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ثبت شد.', $next_url);
    }

    public function edit(HotelRoom $hotel_room)
    {
        return view('place::dashboard.hotel_rooms.form', compact('hotel_room'));
    }

    public function update(HotelRoomRequest $request, HotelRoom $hotel_room)
    {
        $image = $this->UploadFile($request, 'image', 'options_images', $hotel_room->title, $hotel_room->image);
        $hotel_room->update(array_merge($request->all(), ['image' => $image]));

        $next_url = \request('next_url');
        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ویرایش شد.', $next_url);
    }
}
