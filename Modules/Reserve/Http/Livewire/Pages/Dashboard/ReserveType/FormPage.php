<?php

namespace Modules\Reserve\Http\Livewire\Pages\Dashboard\ReserveType;

use Livewire\Component;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';
    public $item;

    public function render()
    {
        return view('reserve::livewire.pages.dashboard.reserve-type.form-page');
    }
}
