<?php

namespace Modules\Ticket\Http\Livewire\Pages\Dashboard\TicketCategory;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Ticket\Entities\TicketCategory;

class ListPage extends Component
{
    use WithPagination;
    use BulkActions;

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

    public function destroy(TicketCategory $ticketCategory)
    {
        $ticketCategory->delete();
    }

    public function render()
    {
        $this->items = TicketCategory::Search($this->search)->latest()->paginate($this->pagination);
        return view('ticket::livewire.pages.dashboard.ticket-category.list-page', ['items' => $this->items]);
    }
}
