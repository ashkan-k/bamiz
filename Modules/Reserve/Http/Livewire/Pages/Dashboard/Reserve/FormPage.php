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
        $data = [
            'places' => Place::all(),
            'options' => Option::all(),
            'users' => User::all(),
        ];

        return view('reserve::livewire.pages.dashboard.reserve.form-page', $data);
    }
}
