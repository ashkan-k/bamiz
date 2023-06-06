<?php

namespace Modules\Option\Http\Controllers\Dashboard;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OptionPlaceController extends Controller
{
    public function index()
    {
        return view('option::dashboard.option_place.list');
    }
}
