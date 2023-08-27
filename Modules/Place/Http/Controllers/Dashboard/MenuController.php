<?php

namespace Modules\Place\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Gallery\Entities\Gallery;
use Modules\Gallery\Http\Requests\GalleryRequest;
use Modules\Place\Entities\Place;

class MenuController extends Controller
{
    use Responses, Uploader;

    public function index()
    {
        return view('place::dashboard.menus.list');
    }

    public function create()
    {
        return view('place::dashboard.menus.form');
    }

    public function store(GalleryRequest $request)
    {
        $place = Place::findOrFail($request->place_id);
        $images = $request->file('images', []);

        foreach ($images as $image) {
            $image = $this->Upload($image, 'places_galleries', $place->name);
            $place->images()->create(['image' => $image]);
        }

        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ثبت شد.', $request->next_url);
    }
}
