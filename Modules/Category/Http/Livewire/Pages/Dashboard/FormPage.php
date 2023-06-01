<?php

namespace Modules\Category\Http\Livewire\Pages\Dashboard;

use Livewire\Component;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        return view('category::livewire.pages.dashboard.form-page');
    }
}
