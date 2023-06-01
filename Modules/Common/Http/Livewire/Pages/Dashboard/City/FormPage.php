<?php

namespace Modules\Common\Http\Livewire\Pages\Dashboard\City;

use Livewire\Component;
use Modules\Common\Entities\Province;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;
    protected $provinces;

    public function render()
    {
        $this->provinces = Province::all();
        return view('common::livewire.pages.dashboard.city.form-page', ['provinces' => $this->provinces]);
    }
}
