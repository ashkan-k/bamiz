<?php

namespace Modules\Gallery\Http\Livewire\Pages\Dashboard;

use Livewire\Component;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        return view('gallery::livewire.pages.dashboard.form-page');
    }
}
