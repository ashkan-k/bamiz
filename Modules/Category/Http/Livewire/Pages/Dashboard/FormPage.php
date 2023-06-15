<?php

namespace Modules\Category\Http\Livewire\Pages\Dashboard;

use Livewire\Component;
use Modules\Category\Entities\Category;

class FormPage extends Component
{
    public $titlePage;
    public $type = '';

    public $item;
    protected $parents;

    public function render()
    {
        $this->parents = Category::query();
        if ($this->item){
            $this->parents = $this->parents->whereNot('id', $this->item->id);
        }

        return view('category::livewire.pages.dashboard.form-page', ['parents' => $this->parents->get()]);
    }
}
