<?php

namespace Modules\WishList\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WishListController extends Controller
{
    public function index()
    {
        return view('wishlist::dashboard.list');
    }
}
