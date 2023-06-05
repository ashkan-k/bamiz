<?php

namespace Modules\Gallery\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Gallery\Entities\Gallery;

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

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
    }

    public function render()
    {
        $this->items = Gallery::Search($this->search)->latest()->paginate($this->pagination);
        return view('gallery::livewire.pages.dashboard.list-page', ['items' => $this->items]);
    }
}
