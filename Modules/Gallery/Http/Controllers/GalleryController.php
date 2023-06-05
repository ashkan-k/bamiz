<?php

namespace Modules\Gallery\Http\Controllers;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Gallery\Entities\Gallery;
use Modules\Gallery\Http\Requests\GalleryRequest;
use Modules\Place\Entities\Place;

class GalleryController extends Controller
{
    use Responses, Uploader;

    public function index()
    {
        return view('gallery::dashboard.list');
    }

    public function create()
    {
        return view('gallery::dashboard.form');
    }

    public function store(GalleryRequest $request)
    {
        $place = Place::find($request->place_id);
        $image = $this->UploadFile($request, 'image', 'places_galleries', $place->name);

        Gallery::create(array_merge($request->validated(), ['image' => $image]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'galleries.index');
    }

    public function edit(Gallery $gallery)
    {
        return view('galleries::dashboard.form', compact('gallery'));
    }

    public function update(GalleryRequest $request, Gallery $gallery)
    {
        $place = Place::find($request->place_id);
        $image = $this->UploadFile($request, 'image', 'places_galleries', $place->name, $gallery->image);

        $gallery->update(array_merge($request->validated(), ['image' => $image]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'galleries.index');
    }
}
