<?php

namespace Modules\Article\Http\Controllers\Front;

use App\Http\Traits\ImageUploader;
use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Place\Entities\Place;
use Modules\Place\Http\Requests\PlaceRequest;

class FrontArticleController extends Controller
{
    public function articles()
    {
        return view('article::front.articles');
    }
}
