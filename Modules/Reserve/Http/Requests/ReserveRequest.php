<?php

namespace Modules\Reserve\Http\Requests;

use Hekmatinasser\Verta\Verta;
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
        $after_date = \verta()->formatDate();
        if (request('place_type') == 'hotel') {
            $before_date = \verta()->addMonth();
        } else {
            $before_date = \verta()->addWeek();
        }
        $date_rules = "required|jdate:Y-m-d|after:{$after_date}|before:{$before_date}";

        return [
            'date' => $date_rules,
//            'start_time' => 'required|date_format:H:i',
            'start_time' => 'required|numeric',
//            'end_time' => 'date_format:H:i|after:start_time',
            'guest_count' => 'required|numeric',
            'chair_number' => 'nullable|numeric',
            'room_number' => 'nullable|numeric',
            'days_number' => 'nullable|numeric',
            'amount' => 'numeric|min:1',
            'user_id' => 'required|exists:users,id',
            'place_id' => 'required|exists:places,id',
            'option_id.*' => 'numeric|exists:options,id',
            'reserve_type_id' => 'nullable|exists:reserve_types,id',
            'table_id' => 'nullable|exists:tables,id',
            'hotel_room_id' => 'nullable|exists:hotel_rooms,id',
            'user_description' => 'nullable',
//            'type' => 'nullable|in:table_for_food,work_appointment,table_for_birth_day_with_food,table_for_birth_day_without_food',
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
