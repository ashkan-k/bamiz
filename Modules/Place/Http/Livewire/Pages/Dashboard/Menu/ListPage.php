<?php

namespace Modules\Place\Http\Livewire\Pages\Dashboard\Menu;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Place\Entities\Menu;

class ListPage extends Component
{
    use WithPagination;
    use BulkActions;

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

    public function destroy(Menu $menu)
    {
        $menu->delete();
    }

    private function FilterByPlace()
    {
        $this->items = $this->place_id ? $this->items->where(['place_id' => $this->place_id]) : $this->items;
        return $this->items;
    }

    public function render()
    {
        $this->items = Menu::Search($this->search)->latest();
        $this->items = $this->FilterByPlace();
        return view('place::livewire.pages.dashboard.menu.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
