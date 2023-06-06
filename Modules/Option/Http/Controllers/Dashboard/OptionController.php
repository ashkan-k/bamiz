<?php

namespace Modules\Option\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Option\Entities\Option;
use Modules\Option\Http\Requests\OptionRequest;

class OptionController extends Controller
{
    use Responses, Uploader;

    public function index()
    {
        return view('option::dashboard.option.list');
    }

    public function create()
    {
        return view('option::dashboard.option.form');
    }

    public function store(OptionRequest $request)
    {
        $image = $this->UploadFile($request, 'image', 'options_images', $request->title);

        Option::create(array_merge($request->all(), ['image' => $image]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'options.index');
    }

    public function edit(Option $option)
    {
        return view('option::dashboard.option.form', compact('option'));
    }

    public function update(OptionRequest $request, Option $option)
    {
        $image = $this->UploadFile($request, 'image', 'options_images', $option->title, $option->image);

        $option->update(array_merge($request->all(), ['image' => $image]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'options.index');
    }
}
