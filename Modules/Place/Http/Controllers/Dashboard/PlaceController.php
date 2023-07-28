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
    use Responses, ImageUploader, Uploader;

    public function index()
    {
        return view('place::dashboard.places.list');
    }

    public function create()
    {
        return view('place::dashboard.places.form');
    }

    public function store(PlaceRequest $request)
    {
        $cover = $this->UploadImage($request->cover, 'places_covers', $request->name);
        $menu_image = $this->UploadImage($request->menu_image, 'places_menu_images', $request->name);
        $banner = $this->UploadFile($request, 'banner', 'places_banners', $request->name);
        $tour_gif = $this->UploadFile($request, 'tour_gif', 'places_tour_gifs', $request->name);

        Place::create(array_merge($request->validated(), ['cover' => $cover, 'menu_image' => $menu_image, 'tour_gif' => $tour_gif, 'banner' => $banner]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'places.index');
    }

    public function edit(Place $place)
    {
        return view('place::dashboard.places.form', compact('place'));
    }

    public function update(PlaceRequest $request, Place $place)
    {
        $cover = $request->cover ? $this->UploadImage($request->cover, 'places_covers', $request->name) : $place->cover;
        $menu_image = $request->menu_image ? $this->UploadImage($request->menu_image, 'places_menu_images', $request->name) : $place->menu_image;
        $banner = $this->UploadFile($request, 'banner', 'places_banners', $request->name, $place->banner);
        $tour_gif = $this->UploadFile($request, 'tour_gif', 'places_tour_gifs', $request->name, $place->tour_gif);

        $place->update(array_merge($request->validated(), ['cover' => $cover, 'menu_image' => $menu_image, 'tour_gif' => $tour_gif, 'banner' => $banner]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'places.index');
    }
}
