<?php

namespace Modules\Option\Http\Livewire\Pages\Dashboard\Option;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Option\Entities\Option;

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

    public function destroy(Option $option)
    {
        $option->delete();
    }

    public function render()
    {
        $this->items = Option::Search($this->search)->latest()->paginate($this->pagination);
        return view('option::livewire.pages.dashboard.option.list-page', ['items' => $this->items]);
    }
}
