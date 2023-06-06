<?php

namespace Modules\Cooperation\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Cooperation\Entities\Cooperation;

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

    public function destroy(Cooperation $cooperation)
    {
        $cooperation->delete();
    }

    public function render()
    {
        $this->items = Cooperation::Search($this->search)->latest()->paginate($this->pagination);
        return view('cooperation::livewire.pages.dashboard.list-page', ['items' => $this->items]);
    }
}
