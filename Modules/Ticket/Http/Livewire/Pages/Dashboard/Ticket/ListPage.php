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
    public $status;
    public $data;
    protected $items;

    protected $listeners = ['triggerChangeStatusModal'];

    public function mount()
    {
        $this->status = request('status');
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination'])) {
            $this->resetPage();
        }
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
    }

    // Change User Status
    public function triggerChangeStatusModal(Ticket $ticket)
    {
        $this->item = $ticket;
        $this->data['status'] = $ticket->status;
    }

    public function ChangeStatus()
    {
        $this->item->status = $this->data['status'];
        $this->item->save();
        $this->dispatchBrowserEvent('itemStatusUpdated');
    }

    public function render()
    {
        $this->items = Ticket::Search($this->search)->latest();
        if (auth()->user()->level != 'admin'){
            $this->items = $this->items->whereBelongsTo(auth()->user());
        }
        return view('ticket::livewire.pages.dashboard.ticket.list-page', ['items' => $this->items ->paginate($this->pagination)]);
    }
}
