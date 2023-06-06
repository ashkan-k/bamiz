<?php

namespace Modules\Food\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Food\Entities\Food;

class ListPage extends Component
{
    use WithPagination;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    public $place_id;
    public $full_url;
    protected $items;

    public function mount()
    {
        $this->place_id = request('place_id');
        $this->full_url = request()->fullUrl();
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination']))
        {
            $this->resetPage();
        }
    }

    public function destroy(Food $food)
    {
        $food->delete();
    }

    private function FilterByPlace()
    {
        $this->items = $this->place_id ? $this->items->where(['place_id' => $this->place_id]) : $this->items;
        return $this->items;
    }

    public function render()
    {
        $this->items = Food::Search($this->search)->latest();
        $this->items = $this->FilterByPlace();
        return view('food::livewire.pages.dashboard.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
