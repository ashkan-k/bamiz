<?php

namespace Modules\User\Http\Livewire\Pages\Dashboard;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\User\Entities\User;

class ListPage extends Component
{
    use WithPagination;
    use BulkActions;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    public $data;
    public $level;
    public $is_active;
    protected $items;
    public $level_filter_items = [
        ['id' => 'user', 'name' => 'کابر عادی'],
        ['id' => 'staff', 'name' => 'کارمند'],
        ['id' => 'admin', 'name' => 'ادمین'],
        ['id' => 'restaurant_manager', 'name' => 'مدیر رستوران'],
    ];
    public $status_filter_items = [
        ['id' => '1', 'name' => 'فعال'],
        ['id' => '0', 'name' => 'غیرفعال'],
    ];

    protected $listeners = ['triggerChangeLevelModal', 'triggerChangeActiveModal'];

    public function mount()
    {
        $this->level = request('level');
        $this->is_active = request('is_active');
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination'])) {
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

    private function Filter()
    {
        $this->items = $this->level ? $this->items->where(['level' => $this->level]) : $this->items;

        if ($this->is_active) {
            $this->items = $this->items->whereNotNull('email_verified_at');
        } elseif ($this->is_active != null) {
            $this->items = $this->items->whereNull('email_verified_at');
        }

        return $this->items;
    }

    public function render()
    {
        $this->items = User::Search($this->search)->latest();
        $this->items = $this->Filter();
        return view('user::livewire.pages.dashboard.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
