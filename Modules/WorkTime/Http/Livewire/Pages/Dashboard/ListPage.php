<?php

namespace Modules\WorkTime\Http\Livewire\Pages\Dashboard;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\WorkTime\Entities\WorkTime;

class ListPage extends Component
{
    use WithPagination;
    use BulkActions;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    protected $items;
    public $full_url;
    public $place_id;

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

    public function destroy(WorkTime $worktime)
    {
        $worktime->delete();
    }

    private function FilterByPlace()
    {
        $this->items = $this->place_id ? $this->items->where(['place_id' => $this->place_id]) : $this->items;
        return $this->items;
    }

    public function render()
    {
        $this->items = WorkTime::Search($this->search)->latest();
        $this->items = $this->FilterByPlace();
        return view('worktime::livewire.pages.dashboard.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
