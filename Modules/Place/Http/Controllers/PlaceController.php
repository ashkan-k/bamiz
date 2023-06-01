<?php

namespace Modules\Place\Http\Controllers;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Place\Entities\Place;
use Modules\Place\Http\Requests\PlaceRequest;

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

    public function store(PlaceRequest $request)
    {
        $cover = $this->UploadFile($request, 'cover', 'places_covers', $request->name);

        Place::create(array_merge($request->all(), ['cover' => $cover]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'places.index');
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
