<?php

namespace Modules\Option\Http\Livewire\Pages\Dashboard\Option;

use Livewire\Component;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        return view('option::livewire.pages.dashboard.option.form-page');
    }
}
