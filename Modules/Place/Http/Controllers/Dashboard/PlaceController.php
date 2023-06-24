<?php

namespace Modules\Place\Http\Controllers\Dashboard;

use App\Http\Traits\ImageUploader;
use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Place\Entities\Place;
use Modules\Place\Http\Requests\PlaceRequest;

class PlaceController extends Controller
{
    use Responses, ImageUploader;

    public function index()
    {
        return view('place::dashboard.list');
    }

    public function create()
    {
        return view('place::dashboard.form');
    }

    public function store(PlaceRequest $request)
    {
        $cover = $this->UploadImage($request->cover, 'places_covers', $request->name);

        Place::create(array_merge($request->validated(), ['cover' => $cover]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'places.index');
    }

    public function edit(Place $place)
    {
        return view('place::dashboard.form', compact('place'));
    }

    public function update(PlaceRequest $request, Place $place)
    {
        $cover = $request->cover ? $this->UploadImage($request->cover, 'places_covers', $request->name) : $place->cover;
        $place->update(array_merge($request->validated(), ['cover' => $cover]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'places.index');
    }
}
