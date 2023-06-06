<?php

namespace Modules\Option\Http\Livewire\Pages\Dashboard\OptionPlace;

use Livewire\Component;
use Modules\Option\Entities\Option;
use Modules\Place\Entities\Place;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;
    public $place;
    protected $options;

    public function mount()
    {
        $this->place = Place::findOrFail(request('place_id'));
    }

    public function render()
    {
        $this->options = Option::all();
        return view('option::livewire.pages.dashboard.option-place.form-page', ['options' => $this->options]);
    }
}
