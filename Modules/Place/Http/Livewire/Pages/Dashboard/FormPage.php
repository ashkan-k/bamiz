<?php

namespace Modules\Place\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Modules\Category\Entities\Category;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\User\Entities\User;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;

    protected $users;
    protected $categories;
    protected $provinces;
    protected $cities;

    public function render()
    {
        $data = [
            'users' => User::all(),
            'categories' => Category::all(),
            'provinces' => Province::all(),
            'cities' => City::all(),
        ];

        return view('place::livewire.pages.dashboard.form-page', $data);
    }
}
