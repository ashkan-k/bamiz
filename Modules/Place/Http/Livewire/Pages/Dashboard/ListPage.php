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

    public function destroy(Place $place)
    {
        $place->delete();
    }

    public function render()
    {
        $this->items = Place::Search($this->search)->latest()->paginate($this->pagination);
        return view('place::livewire.pages.dashboard.list-page', ['items' => $this->items]);
    }
}
