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
    protected $places;
    protected $categories;

    public function mount()
    {
        $this->pagination = env('PAGINATION', 10);
    }

    public function SearchAndFilter()
    {
        $this->places = Place::Search($this->search)->Filter();
        dd($this->places);
    }

    private function getCenterBySlug($slug)
    {
        return Center::where('slug' , $slug)->first();
    }

    public function AddToWishList($slug)
    {
        $center = $this->getCenterBySlug($slug);
        if ($center)
        {
            auth()->user()->wish_lists()->create([
                'wish_listable_id' => $center->id,
                'wish_listable_type' => get_class($center),
            ]);
        }
    }

    public function DeleteFromWishList($slug)
    {
        $center = $this->getCenterBySlug($slug);
        if ($center)
        {
            auth()->user()->wish_lists()
                ->where('wish_listable_id', $center->id)->where('wish_listable_type', get_class($center))->delete();
        }
    }

    private function getData()
    {
        $this->places = Place::with(['wish_lists'])->latest()->paginate($this->pagination);
        $this->categories = Category::all();
    }

    public function render()
    {
        $this->getData();
        return view('front::livewire.front.pages.places-page' , ['places' => $this->places, 'categories' => $this->categories]);
    }
}
