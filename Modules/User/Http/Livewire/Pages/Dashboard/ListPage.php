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
    public $data;
    protected $items;

    protected $listeners = ['triggerChangeLevelModal', 'triggerChangeActiveModal'];

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

    // Change User Level
    public function triggerChangeLevelModal(User $user)
    {
        $this->item = $user;
        $this->data['level'] = $user->level;
    }

    public function ChangeLevel()
    {
        $this->item->update(['level' => $this->data['level']]);
        $this->dispatchBrowserEvent('itemLevelUpdated');
    }

    // Change User Active Status
    public function triggerChangeActiveModal(User $user)
    {
        $this->item = $user;
        $this->data['active_status'] = $user->email_verified_at ? 1 : 0;
    }

    public function ChangeActive()
    {
        $status = $this->data['active_status'] ? now() : null;
        $this->item->update(['email_verified_at' => $status]);
        $this->dispatchBrowserEvent('itemActiveUpdated');
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
