<?php

namespace Modules\User\Http\Livewire\Pages\Dashboard;

use Livewire\Component;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $user;

    public function render()
    {
        return view('user::livewire.pages.dashboard.form-page');
    }
}
