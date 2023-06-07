<?php

namespace Modules\Ticket\Http\Livewire\Pages\Dashboard\Ticket;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Ticket\Entities\Ticket;

class ListPage extends Component
{
    use WithPagination;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    protected $items;

    public function mount()
    {
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination']))
        {
            $this->resetPage();
        }
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
    }

    public function render()
    {
        $this->items = Ticket::Search($this->search)->latest()->paginate($this->pagination);
        return view('ticket::livewire.pages.dashboard.ticket.list-page', ['items' => $this->items]);
    }
}
