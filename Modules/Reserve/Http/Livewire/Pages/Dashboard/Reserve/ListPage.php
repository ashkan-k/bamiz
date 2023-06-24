<?php

namespace Modules\Reserve\Http\Livewire\Pages\Dashboard\Reserve;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Reserve\Entities\Reserve;

class ListPage extends Component
{
    use WithPagination;
    use BulkActions;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    public $data;
    public $status;
    protected $items;
    public $status_filter_items = [
        ['id' => '1', 'name' => 'موفق'],
        ['id' => '0', 'name' => 'ناموفق'],
    ];

    protected $listeners = ['triggerChangeStatusModal'];

    public function mount()
    {
        $this->status = request('status');
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination']))
        {
            $this->resetPage();
        }
    }

    public function destroy(Reserve $reserve)
    {
        $reserve->delete();
    }

    // Change User Status
    public function triggerChangeStatusModal(Reserve $reserve)
    {
        $this->item = $reserve;
        $this->data['status'] = $reserve->status;
    }

    public function ChangeStatus()
    {
        $this->item->status = $this->data['status'];
        $this->item->save();
        $this->dispatchBrowserEvent('itemStatusUpdated');
    }

    private function Filter()
    {
        $this->items = $this->status != null ? $this->items->where(['status' => $this->status]) : $this->items;
        return $this->items;
    }

    public function render()
    {
        $this->items = Reserve::Search($this->search)->latest();
        $this->items = $this->Filter();
        return view('reserve::livewire.pages.dashboard.reserve.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
