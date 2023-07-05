<?php

namespace Modules\Gallery\Http\Controllers\Front;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Gallery\Entities\Gallery;
use Modules\Gallery\Http\Requests\GalleryRequest;
use Modules\Place\Entities\Place;

class FrontGalleryController extends Controller
{
    use Responses, Uploader;

    public function galleries()
    {
        return view('gallery::front.galleries');
    }
}
