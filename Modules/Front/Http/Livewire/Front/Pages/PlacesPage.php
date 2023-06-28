<?php

namespace Modules\Front\Http\Livewire\Front\Pages;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Category\Entities\Category;
use Modules\Place\Entities\Place;

class PlacesPage extends Component
{
    use WithPagination;

    public $titlePage = '';
    public $pagination;
    public $search = '';
    public $place_id;
    public $category;
    protected $places;
    protected $categories;

    public function mount()
    {
        $this->pagination = env('PAGINATION', 10);
    }

    public function AddToWishList(Place $place)
    {
        auth()->user()->wish_lists()->create([
            'wish_listable_id' => $place->id,
            'wish_listable_type' => get_class($place),
        ]);
    }

    public function DeleteFromWishList(Place $place)
    {
        auth()->user()->wish_lists()->where('wish_listable_id', $place->id)
            ->where('wish_listable_type', get_class($place))->delete();
    }

    private function FilterByCategory()
    {
        $this->places = $this->category ? $this->places->where('category_id', $this->category) : $this->places;
    }

    public function render()
    {
        $this->places = Place::Search($this->search)->with(['wish_lists'])->latest();
        $this->categories = Category::all();

        $this->FilterByCategory();

        return view('front::livewire.front.pages.places-page', ['places' => $this->places->paginate($this->pagination), 'categories' => $this->categories]);
    }
}
