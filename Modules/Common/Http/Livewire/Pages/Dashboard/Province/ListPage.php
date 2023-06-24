<?php

namespace Modules\Common\Http\Livewire\Pages\Dashboard\Province;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Entities\Province;

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

    public function destroy(Province $province)
    {
        $province->delete();
    }

    public function render()
    {
        $this->items = Province::Search($this->search)->latest()->paginate($this->pagination);
        return view('common::livewire.pages.dashboard.province.list-page', ['items' => $this->items]);
    }
}
