<?php

namespace Modules\Place\Http\Livewire\Pages\Dashboard\Table;

use Livewire\Component;
use Modules\Place\Entities\Place;
use Modules\Reserve\Entities\ReserveType;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        $data = [
            'places' => Place::all(),
            'reserve_types' => ReserveType::whereNull('price')->get(),
        ];

        return view('place::livewire.pages.dashboard.table.form-page', $data);
    }
}
