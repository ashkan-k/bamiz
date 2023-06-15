<?php

namespace Modules\Cooperation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CooperationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required',
            'phone' => 'required|max:11',
            'file' => 'mimes:jpeg,png,bmp,jpg,pdf,xls,xlsx,txt',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
