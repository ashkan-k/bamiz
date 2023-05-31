<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'POST')
        {
            return [
                'email' => 'required|unique:users',
                'password' => 'required|same:rep_password',
                'username' => 'required|unique:users',
                'avatar' => 'mimes:jpeg,png,bmp,jpg',
                'phone' => 'required|max:11|unique:users'
            ];
        }

        return [
            'email' => 'required',
            'username' => 'required',
            'password' => 'same:rep_password',
            'avatar' => 'mimes:jpeg,png,bmp,jpg',
            'phone' => 'required|max:11'
        ];

    }
}
