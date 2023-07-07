<?php

namespace Modules\Place\Http\Livewire\Pages\Dashboard\HotelRoom;

use App\Http\Traits\BulkActions;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Place\Entities\HotelRoom;

class ListPage extends Component
{
    use WithPagination;
    use BulkActions;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    public $data;
    public $place_id;
    protected $items;

    public function mount()
    {
        $this->place_id = request('place_id');
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination']))
        {
            $this->resetPage();
        }
    }

    public function destroy(HotelRoom $hotel_room)
    {
        $hotel_room->delete();
    }

    private function FilterByPlace()
    {
        $this->items = $this->place_id != null ? $this->items->where(['place_id' => $this->place_id]) : $this->items;
    }

    public function render()
    {
        $this->items = HotelRoom::Search($this->search)->with(['place'])->latest();
        $this->FilterByPlace();
        return view('place::livewire.pages.dashboard.hotel-room.list-page', ['items' => $this->items->paginate($this->pagination)]);
    }
}
