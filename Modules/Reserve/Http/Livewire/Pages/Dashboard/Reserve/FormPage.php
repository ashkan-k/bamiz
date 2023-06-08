<?php

namespace Modules\Reserve\Http\Livewire\Pages\Dashboard\Reserve;

use Livewire\Component;
use Modules\Option\Entities\Option;
use Modules\Place\Entities\Place;
use Modules\User\Entities\User;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;
    protected $places;
    protected $options;

    public function render()
    {
        $types = [
            ['id' => 'table_for_food', 'name' => 'رزرو میز برای سرو'],
            ['id' => 'work_appointment', 'name' => 'رزرو میز بدون سفارش (قرارکاری)'],
            ['id' => 'table_for_birth_day_with_food', 'name' => 'رزرو میز برای تولد با سرو'],
            ['id' => 'table_for_birth_day_without_food', 'name' => 'رزرو میز برای تولد بدون سرو'],
        ];

        $data = [
            'places' => Place::all(),
            'options' => Option::all(),
            'users' => User::all(),
            'types' => $types,
        ];

        return view('reserve::livewire.pages.dashboard.reserve.form-page', $data);
    }
}
