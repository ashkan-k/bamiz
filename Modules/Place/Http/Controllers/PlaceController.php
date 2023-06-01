<?php

namespace Modules\Place\Http\Controllers;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PlaceController extends Controller
{
    use Responses, Uploader;

    public function index()
    {
        return view('place::dashboard.list');
    }

    public function create()
    {
        return view('place::dashboard.form');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        return view('place::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }
}
