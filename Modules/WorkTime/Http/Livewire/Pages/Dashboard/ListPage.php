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

    public function destroy(WorkTime $worktime)
    {
        $worktime->delete();
    }

    public function render()
    {
        $this->items = WorkTime::Search($this->search)->latest()->paginate($this->pagination);
        return view('worktime::livewire.pages.dashboard.list-page', ['items' => $this->items]);
    }
}
