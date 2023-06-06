<?php

namespace Modules\Cooperation\Http\Controllers\Dashboard;

use App\Http\Traits\Responses;
use App\Http\Traits\Uploader;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cooperation\Entities\Cooperation;
use Modules\Cooperation\Http\Requests\CooperationRequest;

class CooperationController extends Controller
{
    use Responses, Uploader;

    public function index()
    {
        return view('cooperation::dashboard.list');
    }

    public function create()
    {
        return view('cooperation::dashboard.form');
    }

    public function store(CooperationRequest $request)
    {
        $file = $this->UploadFile($request, 'file', 'cooperations_files', $request->first_name . '-' . $request->last_name);

        Cooperation::create(array_merge($request->all(), ['file' => $file]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ثبت شد.', 'cooperations.index');
    }

    public function edit(Cooperation $cooperation)
    {
        return view('cooperation::dashboard.form', compact('cooperation'));
    }

    public function update(CooperationRequest $request, Cooperation $cooperation)
    {
        $file = $this->UploadFile($request, 'file', 'cooperations_files', $cooperation->first_name . '-' . $cooperation->last_name, $cooperation->file);

        $cooperation->update(array_merge($request->all(), ['file' => $file]));
        return $this->SuccessRedirect('آیتم مورد نظر با موفقیت ویرایش شد.', 'cooperations.index');
    }
}
