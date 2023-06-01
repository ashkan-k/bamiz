<?php

namespace Modules\Common\Http\Livewire\Pages\Dashboard\Province;

use Livewire\Component;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        return view('common::livewire.pages.dashboard.province.form-page');
    }
}
