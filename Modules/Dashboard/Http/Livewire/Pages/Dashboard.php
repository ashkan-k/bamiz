<?php

namespace Modules\Dashboard\Http\Livewire\Pages;

use Livewire\Component;
use Modules\Payment\Entities\Payment;
use Modules\Place\Entities\Place;
use Modules\Reserve\Entities\Reserve;
use Modules\User\Entities\User;

class Dashboard extends Component
{
    public $data = [];

    private function GetData()
    {
        $this->data = [
          'income' => Payment::whereStatus(1)->sum('amount'),
          'users_count' => User::count(),
          'restaurants' => Place::count(),
          'reserves' => Reserve::whereStatus(1)->count(),
        ];
    }

    public function render()
    {
        $this->GetData();
        return view('dashboard::livewire.pages.dashboard');
    }
}
