<?php

namespace Modules\Gallery\Http\Livewire\Pages\Front;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Gallery\Entities\Gallery;

class GalleriesPage extends Component
{
    use WithPagination;

    protected $galleries;

    public $pagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->pagination = env('PAGINATION', 10);
    }

    public function render()
    {
        $this->galleries = Gallery::latest()->paginate($this->pagination);
        return view('gallery::livewire.pages.front.galleries-page' , ['galleries' => $this->galleries]);
    }
}
