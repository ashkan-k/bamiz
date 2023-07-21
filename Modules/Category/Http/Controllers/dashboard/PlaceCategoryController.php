<?php

namespace Modules\Category\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Http\Requests\CategoryRequest;

class PlaceCategoryController extends Controller
{
    use Responses, Uploader;


    public function index()
    {
        return view('category::dashboard.list');
    }

    public function create()
    {
        return view('category::dashboard.form');
    }

    public function store(CategoryRequest $request)
    {
        $image = $this->UploadFile($request, 'image', 'category_images', $request->title);

        Category::create(array_merge($request->all(), ['image' => $image]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'place-categories.index');
    }

    public function edit(Category $place_category)
    {
        return view('category::dashboard.form', compact('place_category'));
    }

    public function update(CategoryRequest $request, Category $place_category)
    {
        $image = $this->UploadFile($request, 'image', 'category_images', $place_category->title, $place_category->image);

        $place_category->update(array_merge($request->all(), ['image' => $image]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'place-categories.index');
    }
}
