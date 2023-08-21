<?php

namespace Modules\Option\Http\Livewire\Pages\Dashboard\Option;

use Livewire\Component;
use Modules\Place\Entities\Place;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        $data = [
            'places' => Place::ActivePlaces()->get()
        ];
        return view('option::livewire.pages.dashboard.option.form-page', $data);
    }
}
