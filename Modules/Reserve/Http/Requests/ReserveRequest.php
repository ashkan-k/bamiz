<?php

namespace Modules\Reserve\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date|date_format:Y-m-d|after:now',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'date_format:H:i',
            'guest_count' => 'required|numeric',
            'option_id.*' => 'numeric|exists:options,id'
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
