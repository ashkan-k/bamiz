<?php

namespace Modules\WorkTime\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Modules\Place\Entities\Place;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function mount()
    {
        if ($this->item){
            $this->item->week_days = explode(', ' , $this->item->week_days);
        }
    }

    public function render()
    {
        $places = Place::all();
        return view('worktime::livewire.pages.dashboard.form-page', ['places' => $places]);
    }
}
