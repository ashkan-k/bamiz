<?php

namespace Modules\Food\Http\Livewire\Pages\Dashboard;

use Livewire\Component;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        return view('food::livewire.pages.dashboard.form-page');
    }
}
