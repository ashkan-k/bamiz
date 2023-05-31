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
    public $limit = 10;
    public $search = '';

    protected $items;

    public function mount()
    {
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        dd([$this->pagination]);
        if (in_array($propertyName, ['search', 'pagination']))
        {
            $this->resetPage();
        }
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
