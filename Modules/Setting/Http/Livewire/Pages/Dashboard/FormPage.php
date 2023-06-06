<?php

namespace Modules\Setting\Http\Livewire\Pages\Dashboard;

use Livewire\Component;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        return view('setting::livewire.pages.dashboard.form-page');
    }
}
