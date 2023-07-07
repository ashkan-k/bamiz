<?php

namespace Modules\Place\Http\Livewire\Pages\Dashboard\HotelRoom;

use Livewire\Component;
use Modules\Place\Entities\Place;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        $data = [
            'places' => Place::all(),
        ];

        return view('place::livewire.pages.dashboard.hotel-room.form-page', $data);
    }
}
