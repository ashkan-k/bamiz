<?php

namespace Modules\User\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\User\Entities\User;

class ListPage extends Component
{
    use WithPagination;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    public $current_item_level;
    public $item_id;
    protected $items;

    protected $listeners = ['triggerChangeLevelModal'];

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

    public function triggerChangeLevelModal(User $user)
    {
        $this->item = $user;
        $this->current_item_level = $user->level;
    }

    public function ChangeLevel()
    {
        $this->item->update(['level' => $this->current_item_level]);
        $this->dispatchBrowserEvent('itemLevelUpdated');
    }

    public function destroy(User $user)
    {
        $user->delete();
    }

    public function render()
    {
        $this->items = User::Search($this->search)->latest()->paginate($this->pagination);
        return view('user::livewire.pages.dashboard.list-page', ['items' => $this->items]);
    }
}
