<?php

namespace Modules\Food\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Food\Entities\Food;
use Modules\Food\Http\Requests\FoodRequest;
use Modules\Place\Entities\Place;

class FoodController extends Controller
{
    use Responses, Uploader;

    public function index()
    {
        return view('food::dashboard.list');
    }

    public function create()
    {
        return view('food::dashboard.form');
    }

    public function store(FoodRequest $request)
    {
        $place = Place::findOrFail($request->place_id);
        $image = $this->UploadFile($request, 'image', 'foods_images', $place->name);

        Food::create(array_merge($request->validated(), ['image' => $image]));
        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ثبت شد.', $request->next_url);
    }

    public function edit(Food $food)
    {
        return view('food::dashboard.form', compact('food'));
    }

    public function update(FoodRequest $request, Food $food)
    {
        $place = Place::findOrFail($request->place_id);
        $image = $this->UploadFile($request, 'image', 'foods_images', $place->name, $food->image);

        $food->update(array_merge($request->validated(), ['image' => $image]));
        return $this->SuccessRedirectUrl('آیتم مورد نظر با موفقیت ثبت شد.', $request->next_url);
    }
}
