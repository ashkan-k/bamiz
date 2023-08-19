<?php

namespace Modules\Option\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|string',
            'description' => 'required',
            'amount' => 'required|numeric',
            'discount_amount' => 'nullable|numeric',
            'image' => 'nullable|mimes:jpeg,png,bmp,jpg',
        ];

//        if (request()->method == 'POST'){
//            $rules['image'] .= '|required';
//        }

        return $rules;
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
