<?php

namespace Modules\Ticket\Http\Livewire\Pages\Dashboard\TicketAnswer;

use Livewire\Component;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    public function render()
    {
        $data = [
            'answers' => $this->item->answers()->get()
        ];
        return view('ticket::livewire.pages.dashboard.ticket-answer.form-page', $data);
    }
}
