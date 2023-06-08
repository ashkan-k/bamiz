<?php

namespace Modules\Place\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Place\Entities\Place;

class ListPage extends Component
{
    use WithPagination;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    public $data;
    public $is_active;
    protected $items;
    public $status_filter_items = [
        ['id' => '1', 'name' => 'فعال'],
        ['id' => '0', 'name' => 'غیرفعال'],
    ];

    protected $listeners = ['triggerChangeStatusModal'];

    public function mount()
    {
        $this->is_active = request('is_active');
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination']))
        {
            $this->resetPage();
        }
    }

    public function destroy(Place $place)
    {
        $place->delete();
    }

    // Change User Status
    public function triggerChangeStatusModal(Place $place)
    {
        $this->item = $place;
        $this->data['is_active'] = $place->is_active;
    }

    public function ChangeStatus()
    {
        $this->item->is_active = $this->data['is_active'];
        $this->item->save();
        $this->dispatchBrowserEvent('itemStatusUpdated');
    }

    private function FilterByStatus()
    {
        $this->items = $this->is_active != null ? $this->items->where(['is_active' => $this->is_active]) : $this->items;
        return $this->items;
    }

    public function render()
    {
        $this->items = Place::Search($this->search)->latest();
        $this->items = $this->FilterByStatus();
        return view('place::livewire.pages.dashboard.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
