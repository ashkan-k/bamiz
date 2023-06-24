<?php

namespace Modules\WishList\Http\Livewire\Pages\Dashboard;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\WishList\Entities\WishList;

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

    public function destroy(WishList $wishlist)
    {
        $wishlist->delete();
    }

    public function render()
    {
        $this->items = WishList::Search($this->search)->latest()->paginate($this->pagination);
        return view('wishlist::livewire.pages.dashboard.list-page', ['items' => $this->items]);
    }
}
