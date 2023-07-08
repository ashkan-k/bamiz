<?php

namespace Modules\Front\Http\Livewire\Pages\Front;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Reserve\Entities\Reserve;

class ProfilePage extends Component
{
    use WithPagination;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    public $data;
    public $status;
    protected $items;

    public function mount()
    {
        $this->status = request('status');
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination']))
        {
            $this->resetPage();
        }
    }

    public function cancel(Reserve $reserve)
    {
        $reserve->delete();
    }

    private function Filter()
    {
        $this->items = $this->status != null ? $this->items->where(['status' => $this->status]) : $this->items;
        return $this->items;
    }

    public function render()
    {
        $this->items = auth()->user()->reserves()->latest();
        $this->items = $this->Filter();
        return view('front::livewire.pages.front.profile-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
