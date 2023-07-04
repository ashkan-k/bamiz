<?php

namespace Modules\WishList\Http\Controllers\Front;

use App\Http\Traits\ImageUploader;
use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Place\Entities\Place;
use Modules\Place\Http\Requests\PlaceRequest;

class FrontWishlistController extends Controller
{
    public function wishlists()
    {
        return view('wishlist::front.wishlists');
    }
}
