<?php

namespace Modules\Ticket\Http\Livewire\Pages\Dashboard\Ticket;

use Livewire\Component;
use Modules\Ticket\Entities\TicketCategory;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        $data = [
            'categories' => TicketCategory::all()
        ];
        return view('ticket::livewire.pages.dashboard.ticket.form-page', $data);
    }
}
