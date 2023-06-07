<?php

namespace Modules\Ticket\Http\Livewire\Pages\Dashboard\TicketCategory;

use Livewire\Component;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        return view('ticket::livewire.pages.dashboard.ticket-category.form-page');
    }
}
