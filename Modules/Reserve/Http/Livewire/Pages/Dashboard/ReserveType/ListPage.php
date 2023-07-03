<?php

namespace Modules\Reserve\Http\Livewire\Pages\Dashboard\ReserveType;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Reserve\Entities\ReserveType;

class ListPage extends Component
{
    use WithPagination;
    use BulkActions;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    public $data;
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

    public function destroy(ReserveType $reserve_type)
    {
        $reserve_type->delete();
    }

    public function render()
    {
        $this->items = ReserveType::Search($this->search)->latest();
        return view('reserve::livewire.pages.dashboard.reserve-type.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
