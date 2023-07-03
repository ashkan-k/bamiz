<?php

namespace Modules\Place\Http\Livewire\Pages\Dashboard\Table;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Place\Entities\Table;

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

    public function destroy(Table $table)
    {
        $table->delete();
    }


    private function FilterByStatus()
    {
        $this->items = $this->is_active != null ? $this->items->where(['is_active' => $this->is_active]) : $this->items;
        return $this->items;
    }

    public function render()
    {
        $this->items = Table::Search($this->search)->with(['reserve_type', 'place'])->latest();
//        $this->items = $this->FilterByStatus();
        return view('place::livewire.pages.dashboard.table.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
