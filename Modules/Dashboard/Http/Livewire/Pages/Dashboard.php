<?php

namespace Modules\Dashboard\Http\Livewire\Pages;

use Livewire\Component;
use Modules\User\Entities\User;

class Dashboard extends Component
{
    public $data = [];

    private function GetData()
    {
        $this->data = [
          'income' => 0,
          'users_count' => User::count(),
          'restaurants' => 0,
          'reserves' => 0,
        ];
    }

    public function render()
    {
        $this->GetData();
        return view('dashboard::livewire.pages.dashboard');
    }
}
