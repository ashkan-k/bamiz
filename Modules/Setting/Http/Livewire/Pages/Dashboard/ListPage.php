<?php

namespace Modules\Setting\Http\Livewire\Pages\Dashboard;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Setting\Entities\Setting;

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

    public function destroy(Setting $setting)
    {
        $setting->delete();
    }

    public function render()
    {
        $this->items = Setting::Search($this->search)->latest()->paginate($this->pagination);
        return view('setting::livewire.pages.dashboard.list-page', ['items' => $this->items]);
    }
}
