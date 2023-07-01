<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                'phone' => [
                    'nullable',
                    'min:11',
                    'max:11',
                    'regex:/(^\+?(09|98|0)?(9([0-9]{9}))$)/',
                    Rule::unique('users', 'phone')->ignore($this->user)
                ],
            ];
        }

        return [
            'email' => 'required',
            'username' => 'required',
            'password' => 'same:rep_password',
            'avatar' => 'mimes:jpeg,png,bmp,jpg',
        ];

    }
}
