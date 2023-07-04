<?php

namespace Modules\Place\Http\Livewire\Pages\Front;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Category\Entities\Category;
use Modules\Common\Entities\City;
use Modules\Common\Entities\Province;
use Modules\Place\Entities\Place;

class PlacesPage extends Component
{
    use WithPagination;

    public $titlePage = '';
    public $pagination;

    public $search = '';
    public $category;

    protected $places;
    protected $categories;
    public $city;

    public function mount()
    {
        $this->search = request('search');
        $this->pagination = env('PAGINATION', 10);
    }

    public function SearchAndFilter()
    {
        // Empty Body just used for reloading page data
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination', 'category', 'city']))
        {
            $this->resetPage();
        }
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

    private function FilterByCity()
    {
        $this->places = $this->city ? $this->places->where('city_id', $this->city) : $this->places;
    }

    public function render()
    {
        $this->places = Place::with(['province', 'category'])->Search($this->search)->with(['wish_lists'])->latest();
        $this->FilterByCategory();
        $this->FilterByCity();

        $data = [
            'places' => $this->places->paginate($this->pagination),
            'categories' => Category::all(),
            'cities' => City::all(),
        ];
        return view('place::livewire.pages.front.places-page', $data);
    }
}
