<?php

namespace Modules\WishList\Http\Livewire\Pages\Front;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Place\Entities\Place;

class WishlistPage extends Component
{
    use WithPagination;

    public $titlePage = '';
    public $pagination;

    protected $places;

    public function mount()
    {
        $this->pagination = env('PAGINATION', 10);
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'pagination']))
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

    public function render()
    {
        $user_wishlists = auth()->user()->wish_lists()->pluck('wish_listable_id')->toArray();
        $this->places = Place::whereIn('id', $user_wishlists)
            ->with(['province', 'category'])
            ->latest()->paginate($this->pagination);

        $data = [
            'places' => $this->places,
        ];
        return view('wishlist::livewire.pages.front.wishlist-page', $data);
    }
}
