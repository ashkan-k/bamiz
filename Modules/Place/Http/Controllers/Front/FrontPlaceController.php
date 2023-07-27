<?php

namespace Modules\Place\Http\Controllers\Front;

use App\Http\Traits\ImageUploader;
use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Place\Entities\Place;
use Modules\Place\Http\Requests\PlaceRequest;

class FrontPlaceController extends Controller
{
    public function places()
    {
        return view('place::front.places');
    }

    public function categories(Category $category)
    {
        return view('place::front.places', compact('category'));
    }

    public function place_detail(Place $place)
    {
        abort_unless($place->is_active, 404);
        return view('place::front.place-detail', compact('place'));
    }
}
