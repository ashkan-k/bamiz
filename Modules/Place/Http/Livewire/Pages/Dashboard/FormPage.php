<?php

namespace Modules\Place\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Modules\Category\Entities\Category;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\Place\Entities\Place;
use Modules\User\Entities\User;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;
    public $province_id;

    protected $users;
    protected $categories;
    protected $provinces;
    protected $cities;

    protected $listeners = ['ProvinceChangeListener'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function ProvinceChangeListener($selectedValue)
    {
        $this->province_id = $selectedValue;
    }

    public function mount()
    {
        if ($this->item) {
            $this->province_id = $this->item->province_id;
        }
    }

    public function render()
    {
        $data = [
            'types' => Place::GetTypes(),
            'users' => User::whereLevel('restaurant_manager')->get(),
            'categories' => Category::all(),
            'provinces' => Province::all(),
            'cities' => $this->province_id ? City::where('province_id', $this->province_id)->get() : [],
        ];

        return view('place::livewire.pages.dashboard.form-page', $data);
    }
}
