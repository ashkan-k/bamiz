<?php

namespace Modules\Common\Http\Livewire\Pages\Dashboard\City;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Common\Entities\City;

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

    public function destroy(City $province)
    {
        $province->delete();
    }

    public function render()
    {
        $this->items = City::Search($this->search)->latest()->paginate($this->pagination);
        return view('common::livewire.pages.dashboard.city.list-page', ['items' => $this->items]);
    }
}
